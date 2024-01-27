<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use App\Appointment;
use App\Doctor;
use App\Book;
use App\VideoBlog;
use App\Smi;
use App\Interconf;
use App\Workshop;
use App\Development;
use App\Rank;
use App\News;
use App\Mail\AppNotification;
use Jenssegers\Agent\Agent;
use PDF;

class MainController extends Controller
{
	public function index()
	{
		$doctors = Doctor::get();
		$news = News::orderBy('id', 'desc')->limit(3)->get();

		return view('welcome', compact('doctors', 'news'));
	}

	public function aboutus()
	{
		return view('frontend.aboutus');
	}

	public function symptoms()
	{
		$doctors = Doctor::get();

		return view('frontend.symptoms.index', compact('doctors'));
	}

	public function sympdata($data)
	{
		$doctors = Doctor::get();

		return view('frontend.symptoms.data.'.$data, compact('doctors'));
	}

	public function ill()
	{
		$doctors = Doctor::get();

		return view('frontend.ill.index', compact('doctors'));
	}

	public function illdata($data)
	{
		$doctors = Doctor::get();

		return view('frontend.ill.data.'.$data, compact('doctors'));
	}

	public function diagnostika()
	{
		$doctors = Doctor::get();

		return view('frontend.diagnostika.index', compact('doctors'));
	}

	public function diagnostikadata($data)
	{
		$doctors = Doctor::get();

		return view('frontend.diagnostika.data.'.$data, compact('doctors'));
	}

	public function treatment()
	{
		$doctors = Doctor::get();

		return view('frontend.treatment.index', compact('doctors'));
	}

	public function treatmentdata($data)
	{
		$doctors = Doctor::get();

		return view('frontend.treatment.data.'.$data, compact('doctors'));
	}

	public function videoblog($lang)
	{
		$videoblogs = VideoBlog::orderBy('id', 'DESC')->paginate(8);

		return view('frontend.videoblog.index', compact('videoblogs', 'lang'));
	}

	public function smi()
	{
		$smi = Smi::get()->toArray();

		$smi = array_chunk($smi, 3);

		return view('frontend.smi.index', compact('smi'));
	}

	public function newsfr(News $news)
	{
		return view('frontend.newsfr', compact('news'));
	}

	public function smidata(Smi $smi)
	{
		return view('frontend.smi.single', compact('smi'));
	}

	public function store_appointment(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'age' => 'numeric',
			'g-recaptcha-response' => 'required|captcha',
			'doctor_id' => 'required',
		]);

		$date = Carbon::parse($request->date)->format('Y-m-d');

		$appointment = Appointment::create([
		        'name' => $request->name,
		        'age' => $request->age,
		        'phone' => $request->phone,
		        'description' => $request->description,
		        'doctor_id' => $request->doctor_id,
		        'date' => $date,
		    ]);

		if ($appointment->exists) {
			Mail::to('main@heartteam.uz')->send(new AppNotification($appointment));
			$appointment->sendToTg();
		}

		$path = 'pdf/'.Carbon::now()->timestamp.'ID'.$appointment->id.'.pdf';
		$pdf = PDF::loadView('frontend.pdf', compact('appointment', 'path'));
		$pdf->save($path);

		return redirect('/app/'.$path);
	}

	public function appointment($path)
	{
		return view('frontend.appview', compact('path'));
	}

	public function doctors()
	{
		$doctors = Doctor::get()->toArray();
		$doctors = array_chunk($doctors, 4);
		
		return view('frontend.doctors', compact('doctors'));
	}

	public function doctor($id)
	{
		$doctor = Doctor::find($id);

		$agent = new Agent();

		if($agent->isMobile()){
			return view('mobile.doctor', compact('doctor'));
		}

		return view('frontend.doctor', compact('doctor'));
	}

	public function workshops()
	{
		$workshops = Workshop::with('competition_table')->orderBy('id', 'DESC')->paginate(8);

		return view('frontend.workshops.index', compact('workshops'));
	}

	public function workshop(Workshop $workshop)
	{
		$rank = Rank::rank($workshop->competition_table);

		return view('frontend.workshops.view', compact('workshop', 'rank'));
	}

	public function internationalc()
	{
		$interconfs = Interconf::orderBy('id', 'DESC')->paginate(8);	

		Rank::interXml();

		return view('frontend.interconfs.index', compact('interconfs'));
	}

	public function internationalcview(Interconf $interconf)
	{
		$xml = new \DOMDocument();
		$xml_monthly = $xml->createElement('monthly');
		$xml->appendChild($xml_monthly);
		Rank::interXmlSingle($interconf, $xml, $xml_monthly);

		return view('frontend.interconfs.view', compact('interconf'));
	}

	public function developments()
	{
		$developments = Development::orderBy('id', 'DESC')->paginate(10);

		return view('frontend.developments.index', compact('developments'));
	}

	public function development(development $development)
	{
		return view('frontend.developments.view', compact('development'));
	}

	public function books()
	{
		$books = Book::orderBy('id', 'DESC')->where('category', 0)->paginate(9);
		$title = 'Книги';

		return view('frontend.books', compact('books', 'title'));
	}

	public function recomends()
	{
		$books = Book::orderBy('id', 'DESC')->where('category', 1)->paginate(9);
		$title = 'Рекомендации';

		return view('frontend.books', compact('books', 'title'));
	}
}
