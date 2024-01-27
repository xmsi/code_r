
                    <div class="appointment-form text-center mt-5 mt-lg-0">
                        <h3 class="mb-5 ">{{ __('Записаться на консультацию') }}</h3>
                        <form action="/appointment" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" name="name" placeholder="{{ __('Фио') }}" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= __('Фио') ?>'" required>
                            </div>
                            <div class="form-group">
                                <input type="number" name="age" min="0" max="150" placeholder="{{ __('Возраст') }}" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= __('Возраст') ?>'" required> 
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone" placeholder="{{ __('Номер телефона') }}" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= __('Номер телефона') ?>'" required> 
                            </div>
                            <div class="form-group">
                                <textarea name="description" cols="20" rows="7"  placeholder="{{ __('Краткое описание жалоб') }}" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= __('Краткое описание жалоб') ?>'"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="input-group-icon mt-10">
                                    <div class="icon"><i class="fa fa-user" aria-hidden="true"></i></div>
                                    <div class="form-select" id="default-select">
                                        <select name="doctor_id" required>
                                            <option value="" disabled selected>Выберите врача</option>
                                            @foreach($doctors as $doctor)
                                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="date" id="datepicker" placeholder="{{ __('Выбрать дату') }}" onfocus="this.placeholder = ''" onblur="this.placeholder = '<?= __('Выбрать дату') ?>'">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="template-btn">Записаться</button>
                            </div>
                        </form>
                    </div>