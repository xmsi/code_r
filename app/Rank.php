<?php 
namespace App;

use Carbon\Carbon;
use App\Interconf;
/**
 * 
 */
class Rank
{
	static function rank($query)
	{
		$a = [];

		foreach ($query as $q) {
			switch ($q->rank) {
				case 1:
					$a[] = [
						'docId' => $q->doctor_id,
						'docName' => $q->doctor->name,
						'rank' => 1
					]; 
					break;
				case 2:
					$a[] = [
						'docId' => $q->doctor_id,
						'docName' => $q->doctor->name,
						'rank' => 2
					]; 
					break;
				case 3:
					$a[] = [
						'docId' => $q->doctor_id,
						'docName' => $q->doctor->name,
						'rank' => 3
					]; 
					break;
			}
		}

		return $a;

	}

	static function imageUpload($request){
        $images = '';
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = $image->getClientOriginalName();
                $imageName = Carbon::now()->timestamp.$imageName;
                $image->move('images/', $imageName);
                $images = $images.$imageName.';';
            }
        }

        return $images;
	}

	static function interXml(){
		$interconfs = Interconf::get();

		$xml = new \DOMDocument();
		$xml_monthly = $xml->createElement('monthly');
		$xml->appendChild($xml_monthly);
		foreach ($interconfs as $interconf) {
			self::interXmlSingle($interconf, $xml, $xml_monthly);
		}
		return $xml->save("assets/events.xml");
	}	

	static function interXmlSingle($interconf, $xml, $xml_monthly){
		$xml_event = $xml->createElement('event');
		$xml_monthly->appendChild( $xml_event );
		$xml_event_id = $xml->createElement('id', $interconf->id);
		$xml_event_name = $xml->createElement('name', $interconf->title);
		$xml_event_startdate = $xml->createElement('startdate', $interconf->start_date);
		$xml_event_enddate = $xml->createElement('enddate', $interconf->end_date);
		$xml_event_url = $xml->createElement('url', '/internationalc/'.$interconf->id);
		$xml_event_color = $xml->createElement('color', '#ffb128');
		$xml_event->appendChild( $xml_event_id );
		$xml_event->appendChild( $xml_event_name );
		$xml_event->appendChild( $xml_event_startdate );
		$xml_event->appendChild( $xml_event_enddate );
		$xml_event->appendChild( $xml_event_url );
		$xml_event->appendChild( $xml_event_color );

		return $xml->save("assets/interconf/event".$interconf->id.".xml");
	}
}

 ?>