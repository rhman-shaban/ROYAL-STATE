@extends('layouts.admin.layout')
@section('title')
<title>{{ $websiteLang->where('lang_key','general_setting')->first()->custom_text }}</title>
@endsection
@section('admin-content')
    <!-- DataTales Example -->
    <div class="row">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $websiteLang->where('lang_key','general_setting')->first()->custom_text }}</h6>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.settings.update',$setting->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('lang_key','exist_logo')->first()->custom_text }}</label>
                            @if ($setting->logo)
                            <div><img src="{{ url($setting->logo) }}" alt="logo" class="w_200"></div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('lang_key','logo')->first()->custom_text }}</label>
                            <div><input type="file" name="logo" class="form-control"></div>
                        </div>

                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('lang_key','exist_favicon')->first()->custom_text }}</label>
                            <br>
                            @if ($setting->favicon)
                            <div><img src="{{ url($setting->favicon) }}" alt="favicon" class="w_50"></div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('lang_key','favicon')->first()->custom_text }}</label>
                            <div><input type="file" name="favicon" class="form-control"></div>
                        </div>


                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('lang_key','sidebar_header')->first()->custom_text }}</label>
                            <input type="text" name="dashboard_header" class="form-control" value="{{ $setting->dashboard_header }}">
                        </div>

                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('lang_key','sidebar_header_icon')->first()->custom_text }}</label>
                            <input type="text" name="dashbaord_header_icon" class="form-control custom-icon-picker" value="{{ $setting->dashbaord_header_icon }}">
                        </div>


                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('lang_key','email_send_contact_msg')->first()->custom_text }}</label>
                            <input type="email" name="email" class="form-control" value="{{ $setting->email }}">
                        </div>

                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('lang_key','save_contact_msg')->first()->custom_text }} </label>
                            <select name="save_contact_message" id="" class="form-control">
                                <option {{ $setting->save_contact_message==0 ? 'selected':'' }} value="0">{{ $websiteLang->where('lang_key','no')->first()->custom_text }}</option>
                                <option {{ $setting->save_contact_message==1 ? 'selected':'' }} value="1">{{ $websiteLang->where('lang_key','yes')->first()->custom_text }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('lang_key','layout')->first()->custom_text }}</label>
                            <select name="text_direction" id="" class="form-control">
                                <option {{ $setting->text_direction=='LTR' ? 'selected':'' }} value="LTR">{{ $websiteLang->where('lang_key','ltr')->first()->custom_text }}</option>
                                <option {{ $setting->text_direction=='RTL' ? 'selected':'' }} value="RTL">{{ $websiteLang->where('lang_key','rtl')->first()->custom_text }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('lang_key','currency_name')->first()->custom_text }}</label>
                            <select name="currency_name" id="" class="form-control select2">
                                <option value="">{{ $websiteLang->where('lang_key','select_currency')->first()->custom_text }}
                              </option>
                                @foreach ($currencies as $currency)
                                <option {{ $setting->currency_name == $currency->code ? 'selected' : '' }} value="{{ $currency->code }}">{{ $currency->name }}
                                </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('lang_key','currency_icon')->first()->custom_text }}</label>
                            <input type="text" class="form-control" name="currency_icon" value="{{ $setting->currency_icon }}">
                        </div>

                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('lang_key','currency_rate')->first()->custom_text }}</label>
                            <input type="text" class="form-control" name="currency_rate" value="{{ $setting->currency_rate }}">
                        </div>



                        <div class="form-group">
                            <label for="">{{ $websiteLang->where('lang_key','pre_notify_day')->first()->custom_text }}</label>
                            <input type="number" class="form-control" name="prenotification_day" value="{{ $setting->prenotification_day }}">
                        </div>


        <div class="form-group">
            <label for="">{{ $websiteLang->where('lang_key','timezone')->first()->custom_text }}</label>
            <select name="timezone" id="" class="form-control select2">
                <option {{ $setting->timezone == 'Africa/Abidjan' ? 'selected' : '' }} value="Africa/Abidjan" selected>Africa/Abidjan</option>
                <option {{ $setting->timezone == 'Africa/Accra' ? 'selected' : '' }} value="Africa/Accra" >Africa/Accra</option>
                <option  {{ $setting->timezone == 'Africa/Addis_Ababa' ? 'selected' : '' }}value="Africa/Addis_Ababa" >Africa/Addis_Ababa</option>
                <option {{ $setting->timezone == 'Africa/Algiers' ? 'selected' : '' }} value="Africa/Algiers" >Africa/Algiers</option>
                <option  {{ $setting->timezone == 'Africa/Asmara' ? 'selected' : '' }}value="Africa/Asmara" >Africa/Asmara</option>
                <option  {{ $setting->timezone == 'Africa/Bamako' ? 'selected' : '' }}value="Africa/Bamako" >Africa/Bamako</option>
                <option  {{ $setting->timezone == 'Africa/Bangui' ? 'selected' : '' }}value="Africa/Bangui" >Africa/Bangui</option>
                <option {{ $setting->timezone == 'Africa/Banjul' ? 'selected' : '' }} value="Africa/Banjul" >Africa/Banjul</option>
                <option {{ $setting->timezone == 'Africa/Bissau' ? 'selected' : '' }} value="Africa/Bissau" >Africa/Bissau</option>
                <option {{ $setting->timezone == 'Africa/Blantyre' ? 'selected' : '' }} value="Africa/Blantyre" >Africa/Blantyre</option>
                <option {{ $setting->timezone == 'Africa/Brazzaville' ? 'selected' : '' }} value="Africa/Brazzaville" >Africa/Brazzaville</option>
                <option {{ $setting->timezone == 'Africa/Bujumbura' ? 'selected' : '' }} value="Africa/Bujumbura" >Africa/Bujumbura</option>
                <option {{ $setting->timezone == 'Africa/Cairo"' ? 'selected' : '' }} value="Africa/Cairo" >Africa/Cairo</option>
                <option {{ $setting->timezone == 'Africa/Casablanca' ? 'selected' : '' }} value="Africa/Casablanca" >Africa/Casablanca</option>
                <option {{ $setting->timezone == 'Africa/Ceuta' ? 'selected' : '' }} value="Africa/Ceuta" >Africa/Ceuta</option>
                <option {{ $setting->timezone == 'Africa/Conakry' ? 'selected' : '' }} value="Africa/Conakry" >Africa/Conakry</option>
                <option {{ $setting->timezone == 'Africa/Dakar' ? 'selected' : '' }} value="Africa/Dakar" >Africa/Dakar</option>
                <option {{ $setting->timezone == 'Africa/Dar_es_Salaam' ? 'selected' : '' }} value="Africa/Dar_es_Salaam" >Africa/Dar_es_Salaam</option>
                <option {{ $setting->timezone == 'Africa/Djibouti' ? 'selected' : '' }} value="Africa/Djibouti" >Africa/Djibouti</option>
                <option {{ $setting->timezone == 'Africa/Douala' ? 'selected' : '' }} value="Africa/Douala" >Africa/Douala</option>
                <option {{ $setting->timezone == 'Africa/El_Aaiun' ? 'selected' : '' }} value="Africa/El_Aaiun" >Africa/El_Aaiun</option>
                <option {{ $setting->timezone == 'Africa/Freetown' ? 'selected' : '' }} value="Africa/Freetown" >Africa/Freetown</option>
                <option {{ $setting->timezone == 'Africa/Gaborone' ? 'selected' : '' }} value="Africa/Gaborone" >Africa/Gaborone</option>
                <option {{ $setting->timezone == 'Africa/Harare' ? 'selected' : '' }} value="Africa/Harare" >Africa/Harare</option>
                <option {{ $setting->timezone == 'Africa/Johannesburg' ? 'selected' : '' }} value="Africa/Johannesburg" >Africa/Johannesburg</option>
                <option {{ $setting->timezone == 'Africa/Juba' ? 'selected' : '' }} value="Africa/Juba" >Africa/Juba</option>
                <option {{ $setting->timezone == 'Africa/Kampala' ? 'selected' : '' }} value="Africa/Kampala" >Africa/Kampala</option>
                <option {{ $setting->timezone == 'Africa/Khartoum' ? 'selected' : '' }} value="Africa/Khartoum" >Africa/Khartoum</option>
                <option {{ $setting->timezone == 'Africa/Kigali' ? 'selected' : '' }} value="Africa/Kigali" >Africa/Kigali</option>
                <option {{ $setting->timezone == 'Africa/Kinshasa' ? 'selected' : '' }} value="Africa/Kinshasa" >Africa/Kinshasa</option>
                <option {{ $setting->timezone == 'Africa/Lagos' ? 'selected' : '' }} value="Africa/Lagos" >Africa/Lagos</option>
                <option {{ $setting->timezone == 'Africa/Libreville' ? 'selected' : '' }} value="Africa/Libreville" >Africa/Libreville</option>
                <option {{ $setting->timezone == 'Africa/Lome' ? 'selected' : '' }} value="Africa/Lome" >Africa/Lome</option>
                <option {{ $setting->timezone == 'Africa/Luanda' ? 'selected' : '' }} value="Africa/Luanda" >Africa/Luanda</option>
                <option {{ $setting->timezone == 'Africa/Lubumbashi' ? 'selected' : '' }} value="Africa/Lubumbashi" >Africa/Lubumbashi</option>
                <option {{ $setting->timezone == 'Africa/Lusaka' ? 'selected' : '' }} value="Africa/Lusaka" >Africa/Lusaka</option>
                <option {{ $setting->timezone == 'Africa/Malabo' ? 'selected' : '' }} value="Africa/Malabo" >Africa/Malabo</option>
                <option {{ $setting->timezone == 'Africa/Maputo' ? 'selected' : '' }} value="Africa/Maputo" >Africa/Maputo</option>
                <option {{ $setting->timezone == 'Africa/Maseru' ? 'selected' : '' }} value="Africa/Maseru" >Africa/Maseru</option>
                <option {{ $setting->timezone == 'Africa/Mbabane' ? 'selected' : '' }} value="Africa/Mbabane" >Africa/Mbabane</option>
                <option {{ $setting->timezone == 'Africa/Mogadishu' ? 'selected' : '' }} value="Africa/Mogadishu" >Africa/Mogadishu</option>
                <option {{ $setting->timezone == 'Africa/Monrovia' ? 'selected' : '' }} value="Africa/Monrovia" >Africa/Monrovia</option>
                <option {{ $setting->timezone == 'Africa/Nairobi' ? 'selected' : '' }} value="Africa/Nairobi" >Africa/Nairobi</option>
                <option {{ $setting->timezone == 'Africa/Ndjamena' ? 'selected' : '' }} value="Africa/Ndjamena" >Africa/Ndjamena</option>
                <option {{ $setting->timezone == 'Africa/Niamey' ? 'selected' : '' }} value="Africa/Niamey" >Africa/Niamey</option>
                <option {{ $setting->timezone == 'Africa/Nouakchott' ? 'selected' : '' }} value="Africa/Nouakchott" >Africa/Nouakchott</option>
                <option {{ $setting->timezone == 'Africa/Ouagadougou' ? 'selected' : '' }} value="Africa/Ouagadougou" >Africa/Ouagadougou</option>
                <option {{ $setting->timezone == 'Africa/Porto-Novo' ? 'selected' : '' }} value="Africa/Porto-Novo" >Africa/Porto-Novo</option>
                <option {{ $setting->timezone == 'Africa/Sao_Tome' ? 'selected' : '' }} value="Africa/Sao_Tome" >Africa/Sao_Tome</option>
                <option {{ $setting->timezone == 'Africa/Tripoli' ? 'selected' : '' }} value="Africa/Tripoli" >Africa/Tripoli</option>
                <option {{ $setting->timezone == 'Africa/Tunis' ? 'selected' : '' }} value="Africa/Tunis" >Africa/Tunis</option>
                <option {{ $setting->timezone == 'Africa/Windhoek' ? 'selected' : '' }} value="Africa/Windhoek" >Africa/Windhoek</option>
                <option {{ $setting->timezone == 'America/Adak' ? 'selected' : '' }} value="America/Adak" >America/Adak</option>
                <option {{ $setting->timezone == 'America/Anchorage' ? 'selected' : '' }} value="America/Anchorage" >America/Anchorage</option>
                <option {{ $setting->timezone == 'America/Anguilla' ? 'selected' : '' }} value="America/Anguilla" >America/Anguilla</option>
                <option {{ $setting->timezone == 'America/Antigua' ? 'selected' : '' }} value="America/Antigua" >America/Antigua</option>
                <option {{ $setting->timezone == 'America/Araguaina' ? 'selected' : '' }} value="America/Araguaina" >America/Araguaina</option>
                <option {{ $setting->timezone == 'America/Argentina/Buenos_Aires' ? 'selected' : '' }} value="America/Argentina/Buenos_Aires" >America/Argentina/Buenos_Aires</option>
                <option {{ $setting->timezone == 'America/Argentina/Catamarca' ? 'selected' : '' }} value="America/Argentina/Catamarca" >America/Argentina/Catamarca</option>
                <option {{ $setting->timezone == 'America/Argentina/Cordoba' ? 'selected' : '' }} value="America/Argentina/Cordoba" >America/Argentina/Cordoba</option>
                <option {{ $setting->timezone == 'America/Argentina/Jujuy' ? 'selected' : '' }} value="America/Argentina/Jujuy" >America/Argentina/Jujuy</option>
                <option {{ $setting->timezone == 'America/Argentina/La_Rioja' ? 'selected' : '' }} value="America/Argentina/La_Rioja" >America/Argentina/La_Rioja</option>
                <option {{ $setting->timezone == 'America/Argentina/Mendoza' ? 'selected' : '' }} value="America/Argentina/Mendoza" >America/Argentina/Mendoza</option>
                <option {{ $setting->timezone == 'America/Argentina/Rio_Gallegos' ? 'selected' : '' }} value="America/Argentina/Rio_Gallegos" >America/Argentina/Rio_Gallegos</option>

                <option {{ $setting->timezone == 'America/Argentina/Salta' ? 'selected' : '' }}  value="America/Argentina/Salta" >America/Argentina/Salta</option>
                <option {{ $setting->timezone == 'America/Argentina/San_Juan' ? 'selected' : '' }}  value="America/Argentina/San_Juan" >America/Argentina/San_Juan</option>
                <option {{ $setting->timezone == 'America/Argentina/San_Luis' ? 'selected' : '' }}  value="America/Argentina/San_Luis" >America/Argentina/San_Luis</option>
                <option {{ $setting->timezone == 'America/Argentina/Tucuman' ? 'selected' : '' }}  value="America/Argentina/Tucuman" >America/Argentina/Tucuman</option>
                <option {{ $setting->timezone == 'America/Argentina/Ushuaia' ? 'selected' : '' }}  value="America/Argentina/Ushuaia" >America/Argentina/Ushuaia</option>
                <option {{ $setting->timezone == 'America/Aruba' ? 'selected' : '' }}  value="America/Aruba" >America/Aruba</option>
                <option {{ $setting->timezone == 'America/Asuncion' ? 'selected' : '' }}  value="America/Asuncion" >America/Asuncion</option>
                <option {{ $setting->timezone == 'America/Atikokan' ? 'selected' : '' }}  value="America/Atikokan" >America/Atikokan</option>
                <option {{ $setting->timezone == 'America/Bahia' ? 'selected' : '' }}  value="America/Bahia" >America/Bahia</option>
                <option {{ $setting->timezone == 'America/Bahia_Banderas' ? 'selected' : '' }}  value="America/Bahia_Banderas" >America/Bahia_Banderas</option>
                <option {{ $setting->timezone == 'America/Barbados' ? 'selected' : '' }}  value="America/Barbados" >America/Barbados</option>
                <option {{ $setting->timezone == 'America/Belem' ? 'selected' : '' }}  value="America/Belem" >America/Belem</option>
                <option {{ $setting->timezone == 'America/Belize' ? 'selected' : '' }}  value="America/Belize" >America/Belize</option>
                <option {{ $setting->timezone == 'America/Blanc-Sablon' ? 'selected' : '' }}  value="America/Blanc-Sablon" >America/Blanc-Sablon</option>
                <option {{ $setting->timezone == 'America/Boa_Vista' ? 'selected' : '' }}  value="America/Boa_Vista" >America/Boa_Vista</option>
                <option {{ $setting->timezone == 'America/Bogota' ? 'selected' : '' }}  value="America/Bogota" >America/Bogota</option>
                <option {{ $setting->timezone == 'America/Boise' ? 'selected' : '' }}  value="America/Boise" >America/Boise</option>
                <option {{ $setting->timezone == 'America/Cambridge_Bay' ? 'selected' : '' }}  value="America/Cambridge_Bay" >America/Cambridge_Bay</option>
                <option {{ $setting->timezone == 'America/Campo_Grande' ? 'selected' : '' }}  value="America/Campo_Grande" >America/Campo_Grande</option>
                <option {{ $setting->timezone == 'America/Cancun' ? 'selected' : '' }}  value="America/Cancun" >America/Cancun</option>
                <option {{ $setting->timezone == 'America/Caracas' ? 'selected' : '' }}  value="America/Caracas" >America/Caracas</option>
                <option {{ $setting->timezone == 'America/Cayenne' ? 'selected' : '' }}  value="America/Cayenne" >America/Cayenne</option>
                <option {{ $setting->timezone == 'America/Cayman' ? 'selected' : '' }}  value="America/Cayman" >America/Cayman</option>
                <option {{ $setting->timezone == 'America/Chicago' ? 'selected' : '' }}  value="America/Chicago" >America/Chicago</option>
                <option {{ $setting->timezone == 'America/Chihuahua' ? 'selected' : '' }}  value="America/Chihuahua" >America/Chihuahua</option>
                <option {{ $setting->timezone == 'America/Costa_Rica' ? 'selected' : '' }}  value="America/Costa_Rica" >America/Costa_Rica</option>
                <option {{ $setting->timezone == 'America/Creston' ? 'selected' : '' }}  value="America/Creston" >America/Creston</option>
                <option {{ $setting->timezone == 'America/Cuiaba' ? 'selected' : '' }}  value="America/Cuiaba" >America/Cuiaba</option>
                <option {{ $setting->timezone == 'America/Curacao' ? 'selected' : '' }}  value="America/Curacao" >America/Curacao</option>
                <option {{ $setting->timezone == 'America/Danmarkshavn' ? 'selected' : '' }}  value="America/Danmarkshavn" >America/Danmarkshavn</option>
                <option {{ $setting->timezone == 'America/Dawson' ? 'selected' : '' }}  value="America/Dawson" >America/Dawson</option>
                <option {{ $setting->timezone == 'America/Dawson_Creek' ? 'selected' : '' }}  value="America/Dawson_Creek" >America/Dawson_Creek</option>
                <option {{ $setting->timezone == 'America/Denver' ? 'selected' : '' }}  value="America/Denver" >America/Denver</option>
                <option {{ $setting->timezone == 'America/Detroit' ? 'selected' : '' }}  value="America/Detroit" >America/Detroit</option>
                <option {{ $setting->timezone == 'America/Dominica' ? 'selected' : '' }}  value="America/Dominica" >America/Dominica</option>
                <option {{ $setting->timezone == 'America/Edmonton' ? 'selected' : '' }}  value="America/Edmonton" >America/Edmonton</option>
                <option {{ $setting->timezone == 'America/Eirunepe' ? 'selected' : '' }}  value="America/Eirunepe" >America/Eirunepe</option>
                <option {{ $setting->timezone == 'America/El_Salvador' ? 'selected' : '' }}  value="America/El_Salvador" >America/El_Salvador</option>
                <option {{ $setting->timezone == 'America/Fort_Nelson' ? 'selected' : '' }}  value="America/Fort_Nelson" >America/Fort_Nelson</option>
                <option {{ $setting->timezone == 'America/Fortaleza' ? 'selected' : '' }}  value="America/Fortaleza" >America/Fortaleza</option>
                <option {{ $setting->timezone == 'America/Glace_Bay' ? 'selected' : '' }}  value="America/Glace_Bay" >America/Glace_Bay</option>
                <option {{ $setting->timezone == 'America/Goose_Bay' ? 'selected' : '' }}  value="America/Goose_Bay" >America/Goose_Bay</option>

                <option {{ $setting->timezone == 'America/Grand_Turk' ? 'selected' : '' }}  value="America/Grand_Turk" >America/Grand_Turk</option>
                <option {{ $setting->timezone == 'America/Grenada' ? 'selected' : '' }}  value="America/Grenada" >America/Grenada</option>
                <option {{ $setting->timezone == 'America/Guadeloupe' ? 'selected' : '' }}  value="America/Guadeloupe" >America/Guadeloupe</option>
                <option {{ $setting->timezone == 'America/Guatemala' ? 'selected' : '' }}  value="America/Guatemala" >America/Guatemala</option>
                <option {{ $setting->timezone == 'America/Guayaquil' ? 'selected' : '' }}  value="America/Guayaquil" >America/Guayaquil</option>
                <option {{ $setting->timezone == 'America/Guyana' ? 'selected' : '' }}  value="America/Guyana" >America/Guyana</option>
                <option {{ $setting->timezone == 'America/Halifax' ? 'selected' : '' }}  value="America/Halifax" >America/Halifax</option>
                <option {{ $setting->timezone == 'America/Havana' ? 'selected' : '' }}  value="America/Havana" >America/Havana</option>
                <option {{ $setting->timezone == 'America/Hermosillo' ? 'selected' : '' }}  value="America/Hermosillo" >America/Hermosillo</option>
                <option {{ $setting->timezone == 'America/Indiana/Indianapolis' ? 'selected' : '' }}  value="America/Indiana/Indianapolis" >America/Indiana/Indianapolis</option>
                <option {{ $setting->timezone == 'America/Indiana/Knox' ? 'selected' : '' }}  value="America/Indiana/Knox" >America/Indiana/Knox</option>
                <option {{ $setting->timezone == 'America/Indiana/Marengo' ? 'selected' : '' }}  value="America/Indiana/Marengo" >America/Indiana/Marengo</option>

                <option {{ $setting->timezone == 'America/Indiana/Petersburg' ? 'selected' : '' }}  value="America/Indiana/Petersburg" >America/Indiana/Petersburg</option>
                <option {{ $setting->timezone == 'America/Indiana/Tell_City' ? 'selected' : '' }}  value="America/Indiana/Tell_City" >America/Indiana/Tell_City</option>
                <option {{ $setting->timezone == 'America/Indiana/Vevay' ? 'selected' : '' }}  value="America/Indiana/Vevay" >America/Indiana/Vevay</option>
                <option {{ $setting->timezone == 'America/Indiana/Vincennes' ? 'selected' : '' }}  value="America/Indiana/Vincennes" >America/Indiana/Vincennes</option>
                <option {{ $setting->timezone == 'America/Indiana/Winamac' ? 'selected' : '' }}  value="America/Indiana/Winamac" >America/Indiana/Winamac</option>
                <option {{ $setting->timezone == 'America/Inuvik' ? 'selected' : '' }}  value="America/Inuvik" >America/Inuvik</option>
                <option {{ $setting->timezone == 'America/Iqaluit' ? 'selected' : '' }}  value="America/Iqaluit" >America/Iqaluit</option>
                <option {{ $setting->timezone == 'America/Jamaica' ? 'selected' : '' }}  value="America/Jamaica" >America/Jamaica</option>
                <option {{ $setting->timezone == 'America/Juneau' ? 'selected' : '' }}  value="America/Juneau" >America/Juneau</option>
                <option {{ $setting->timezone == 'America/Kentucky/Louisville' ? 'selected' : '' }}  value="America/Kentucky/Louisville" >America/Kentucky/Louisville</option>
                <option {{ $setting->timezone == 'America/Kentucky/Monticello' ? 'selected' : '' }}  value="America/Kentucky/Monticello" >America/Kentucky/Monticello</option>
                <option {{ $setting->timezone == 'America/Kralendijk' ? 'selected' : '' }}  value="America/Kralendijk" >America/Kralendijk</option>
                <option {{ $setting->timezone == 'America/La_Paz' ? 'selected' : '' }}  value="America/La_Paz" >America/La_Paz</option>
                <option {{ $setting->timezone == 'America/Lima' ? 'selected' : '' }}  value="America/Lima" >America/Lima</option>
                <option {{ $setting->timezone == 'America/Los_Angeles' ? 'selected' : '' }}  value="America/Los_Angeles" >America/Los_Angeles</option>
                <option {{ $setting->timezone == 'America/Lower_Princes' ? 'selected' : '' }}  value="America/Lower_Princes" >America/Lower_Princes</option>
                <option {{ $setting->timezone == 'America/Maceio' ? 'selected' : '' }}  value="America/Maceio" >America/Maceio</option>
                <option {{ $setting->timezone == 'America/Managua' ? 'selected' : '' }}  value="America/Managua" >America/Managua</option>
                <option {{ $setting->timezone == 'America/Manaus' ? 'selected' : '' }}  value="America/Manaus" >America/Manaus</option>
                <option {{ $setting->timezone == 'America/Marigot' ? 'selected' : '' }}  value="America/Marigot" >America/Marigot</option>
                <option {{ $setting->timezone == 'America/Martinique' ? 'selected' : '' }}  value="America/Martinique" >America/Martinique</option>
                <option {{ $setting->timezone == 'America/Matamoros' ? 'selected' : '' }}  value="America/Matamoros" >America/Matamoros</option>
                <option {{ $setting->timezone == 'America/Mazatlan' ? 'selected' : '' }}  value="America/Mazatlan" >America/Mazatlan</option>
                <option {{ $setting->timezone == 'America/Menominee' ? 'selected' : '' }}  value="America/Menominee" >America/Menominee</option>
                <option {{ $setting->timezone == 'America/Merida' ? 'selected' : '' }}  value="America/Merida" >America/Merida</option>
                <option {{ $setting->timezone == 'America/Metlakatla' ? 'selected' : '' }}  value="America/Metlakatla" >America/Metlakatla</option>
                <option {{ $setting->timezone == 'America/Mexico_City' ? 'selected' : '' }}  value="America/Mexico_City" >America/Mexico_City</option>
                <option {{ $setting->timezone == 'America/Miquelon' ? 'selected' : '' }}  value="America/Miquelon" >America/Miquelon</option>
                <option {{ $setting->timezone == 'America/Moncton' ? 'selected' : '' }}  value="America/Moncton" >America/Moncton</option>
                <option {{ $setting->timezone == 'America/Monterrey' ? 'selected' : '' }}  value="America/Monterrey" >America/Monterrey</option>
                <option {{ $setting->timezone == 'America/Montevideo' ? 'selected' : '' }}  value="America/Montevideo" >America/Montevideo</option>
                <option {{ $setting->timezone == 'America/Montserrat' ? 'selected' : '' }}  value="America/Montserrat" >America/Montserrat</option>
                <option {{ $setting->timezone == 'America/Nassau' ? 'selected' : '' }}  value="America/Nassau" >America/Nassau</option>
                <option {{ $setting->timezone == 'America/New_York' ? 'selected' : '' }}  value="America/New_York" >America/New_York</option>
                <option {{ $setting->timezone == 'America/Nipigon' ? 'selected' : '' }}  value="America/Nipigon" >America/Nipigon</option>
                <option {{ $setting->timezone == 'America/Nome' ? 'selected' : '' }}  value="America/Nome" >America/Nome</option>
                <option {{ $setting->timezone == 'America/Noronha' ? 'selected' : '' }}  value="America/Noronha" >America/Noronha</option>
                <option {{ $setting->timezone == 'America/North_Dakota/Beulah' ? 'selected' : '' }}  value="America/North_Dakota/Beulah" >America/North_Dakota/Beulah</option>
                <option {{ $setting->timezone == 'America/North_Dakota/Center' ? 'selected' : '' }}  value="America/North_Dakota/Center" >America/North_Dakota/Center</option>
                <option {{ $setting->timezone == 'America/North_Dakota/New_Salem' ? 'selected' : '' }}  value="America/North_Dakota/New_Salem" >America/North_Dakota/New_Salem</option>
                <option {{ $setting->timezone == 'America/Nuuk' ? 'selected' : '' }}  value="America/Nuuk" >America/Nuuk</option>
                <option {{ $setting->timezone == 'America/Ojinaga' ? 'selected' : '' }}  value="America/Ojinaga" >America/Ojinaga</option>
                <option {{ $setting->timezone == 'America/Panama' ? 'selected' : '' }}  value="America/Panama" >America/Panama</option>
                <option {{ $setting->timezone == 'America/Pangnirtung' ? 'selected' : '' }}  value="America/Pangnirtung" >America/Pangnirtung</option>
                <option {{ $setting->timezone == 'America/Paramaribo' ? 'selected' : '' }}  value="America/Paramaribo" >America/Paramaribo</option>


                <option {{ $setting->timezone == 'America/Phoenix' ? 'selected' : '' }} value="America/Phoenix" >America/Phoenix</option>
                <option {{ $setting->timezone == 'America/Port-au-Prince' ? 'selected' : '' }} value="America/Port-au-Prince" >America/Port-au-Prince</option>
                <option {{ $setting->timezone == 'America/Port_of_Spain' ? 'selected' : '' }} value="America/Port_of_Spain" >America/Port_of_Spain</option>
                <option {{ $setting->timezone == 'America/Porto_Velho' ? 'selected' : '' }} value="America/Porto_Velho" >America/Porto_Velho</option>
                <option {{ $setting->timezone == 'America/Puerto_Rico' ? 'selected' : '' }} value="America/Puerto_Rico" >America/Puerto_Rico</option>
                <option {{ $setting->timezone == 'America/Punta_Arenas' ? 'selected' : '' }} value="America/Punta_Arenas" >America/Punta_Arenas</option>
                <option {{ $setting->timezone == 'America/Rainy_River' ? 'selected' : '' }} value="America/Rainy_River" >America/Rainy_River</option>
                <option {{ $setting->timezone == 'America/Rankin_Inlet' ? 'selected' : '' }} value="America/Rankin_Inlet" >America/Rankin_Inlet</option>
                <option {{ $setting->timezone == 'America/Recife' ? 'selected' : '' }} value="America/Recife" >America/Recife</option>
                <option {{ $setting->timezone == 'America/Regina' ? 'selected' : '' }} value="America/Regina" >America/Regina</option>
                <option {{ $setting->timezone == 'America/Resolute' ? 'selected' : '' }} value="America/Resolute" >America/Resolute</option>
                <option {{ $setting->timezone == 'America/Rio_Branco' ? 'selected' : '' }} value="America/Rio_Branco" >America/Rio_Branco</option>
                <option {{ $setting->timezone == 'America/Santarem' ? 'selected' : '' }} value="America/Santarem" >America/Santarem</option>
                <option {{ $setting->timezone == 'America/Santiago' ? 'selected' : '' }} value="America/Santiago" >America/Santiago</option>
                <option {{ $setting->timezone == 'America/Santo_Domingo' ? 'selected' : '' }} value="America/Santo_Domingo" >America/Santo_Domingo</option>
                <option {{ $setting->timezone == 'America/Sao_Paulo' ? 'selected' : '' }} value="America/Sao_Paulo" >America/Sao_Paulo</option>
                <option {{ $setting->timezone == 'America/Scoresbysund' ? 'selected' : '' }} value="America/Scoresbysund" >America/Scoresbysund</option>
                <option {{ $setting->timezone == 'America/Sitka' ? 'selected' : '' }} value="America/Sitka" >America/Sitka</option>
                <option {{ $setting->timezone == 'America/St_Barthelemy' ? 'selected' : '' }} value="America/St_Barthelemy" >America/St_Barthelemy</option>
                <option {{ $setting->timezone == 'America/St_Johns' ? 'selected' : '' }} value="America/St_Johns" >America/St_Johns</option>
                <option {{ $setting->timezone == 'America/St_Kitts' ? 'selected' : '' }} value="America/St_Kitts" >America/St_Kitts</option>
                <option {{ $setting->timezone == 'America/St_Lucia' ? 'selected' : '' }} value="America/St_Lucia" >America/St_Lucia</option>
                <option {{ $setting->timezone == 'America/St_Thomas' ? 'selected' : '' }} value="America/St_Thomas" >America/St_Thomas</option>
                <option {{ $setting->timezone == 'America/St_Vincent' ? 'selected' : '' }} value="America/St_Vincent" >America/St_Vincent</option>
                <option {{ $setting->timezone == 'America/Swift_Current' ? 'selected' : '' }} value="America/Swift_Current" >America/Swift_Current</option>
                <option {{ $setting->timezone == 'America/Tegucigalpa' ? 'selected' : '' }} value="America/Tegucigalpa" >America/Tegucigalpa</option>
                <option {{ $setting->timezone == 'America/Thule' ? 'selected' : '' }} value="America/Thule" >America/Thule</option>
                <option {{ $setting->timezone == 'America/Thunder_Bay' ? 'selected' : '' }} value="America/Thunder_Bay" >America/Thunder_Bay</option>
                <option {{ $setting->timezone == 'America/Tijuana' ? 'selected' : '' }} value="America/Tijuana" >America/Tijuana</option>
                <option {{ $setting->timezone == 'America/Toronto' ? 'selected' : '' }} value="America/Toronto" >America/Toronto</option>
                <option {{ $setting->timezone == 'America/Tortola' ? 'selected' : '' }} value="America/Tortola" >America/Tortola</option>
                <option {{ $setting->timezone == 'America/Vancouver' ? 'selected' : '' }} value="America/Vancouver" >America/Vancouver</option>
                <option {{ $setting->timezone == 'America/Whitehorse' ? 'selected' : '' }} value="America/Whitehorse" >America/Whitehorse</option>
                <option {{ $setting->timezone == 'America/Winnipeg' ? 'selected' : '' }} value="America/Winnipeg" >America/Winnipeg</option>
                <option {{ $setting->timezone == 'America/Yakutat' ? 'selected' : '' }} value="America/Yakutat" >America/Yakutat</option>
                <option {{ $setting->timezone == 'America/Yellowknife' ? 'selected' : '' }} value="America/Yellowknife" >America/Yellowknife</option>
                <option {{ $setting->timezone == 'Antarctica/Casey' ? 'selected' : '' }} value="Antarctica/Casey" >Antarctica/Casey</option>
                <option {{ $setting->timezone == 'Antarctica/Davis' ? 'selected' : '' }} value="Antarctica/Davis" >Antarctica/Davis</option>
                <option {{ $setting->timezone == 'Antarctica/DumontDUrville' ? 'selected' : '' }} value="Antarctica/DumontDUrville" >Antarctica/DumontDUrville</option>
                <option {{ $setting->timezone == 'Antarctica/Macquarie' ? 'selected' : '' }} value="Antarctica/Macquarie" >Antarctica/Macquarie</option>


                <option {{ $setting->timezone == 'Antarctica/Mawson' ? 'selected' : '' }} value="Antarctica/Mawson" >Antarctica/Mawson</option>
                <option {{ $setting->timezone == 'Antarctica/McMurdo' ? 'selected' : '' }} value="Antarctica/McMurdo" >Antarctica/McMurdo</option>
                <option {{ $setting->timezone == 'Antarctica/Palmer' ? 'selected' : '' }} value="Antarctica/Palmer" >Antarctica/Palmer</option>
                <option {{ $setting->timezone == 'Antarctica/Rothera' ? 'selected' : '' }} value="Antarctica/Rothera" >Antarctica/Rothera</option>
                <option {{ $setting->timezone == 'Antarctica/Syowa' ? 'selected' : '' }} value="Antarctica/Syowa" >Antarctica/Syowa</option>
                <option {{ $setting->timezone == 'Antarctica/Troll' ? 'selected' : '' }} value="Antarctica/Troll" >Antarctica/Troll</option>
                <option {{ $setting->timezone == 'Antarctica/Vostok' ? 'selected' : '' }} value="Antarctica/Vostok" >Antarctica/Vostok</option>
                <option {{ $setting->timezone == 'Arctic/Longyearbyen' ? 'selected' : '' }} value="Arctic/Longyearbyen" >Arctic/Longyearbyen</option>
                <option {{ $setting->timezone == 'Asia/Aden' ? 'selected' : '' }} value="Asia/Aden" >Asia/Aden</option>
                <option {{ $setting->timezone == 'Asia/Almaty' ? 'selected' : '' }} value="Asia/Almaty" >Asia/Almaty</option>
                <option {{ $setting->timezone == 'Asia/Amman' ? 'selected' : '' }} value="Asia/Amman" >Asia/Amman</option>
                <option {{ $setting->timezone == 'Asia/Anadyr' ? 'selected' : '' }} value="Asia/Anadyr" >Asia/Anadyr</option>
                <option {{ $setting->timezone == 'Asia/Aqtau' ? 'selected' : '' }} value="Asia/Aqtau" >Asia/Aqtau</option>
                <option {{ $setting->timezone == 'Asia/Aqtobe' ? 'selected' : '' }} value="Asia/Aqtobe" >Asia/Aqtobe</option>
                <option {{ $setting->timezone == 'Asia/Ashgabat' ? 'selected' : '' }} value="Asia/Ashgabat" >Asia/Ashgabat</option>
                <option {{ $setting->timezone == 'Asia/Atyrau' ? 'selected' : '' }} value="Asia/Atyrau" >Asia/Atyrau</option>
                <option {{ $setting->timezone == 'Asia/Baghdad' ? 'selected' : '' }} value="Asia/Baghdad" >Asia/Baghdad</option>
                <option {{ $setting->timezone == 'Asia/Bahrain' ? 'selected' : '' }} value="Asia/Bahrain" >Asia/Bahrain</option>
                <option {{ $setting->timezone == 'Asia/Baku' ? 'selected' : '' }} value="Asia/Baku" >Asia/Baku</option>
                <option {{ $setting->timezone == 'Asia/Bangkok' ? 'selected' : '' }} value="Asia/Bangkok" >Asia/Bangkok</option>
                <option {{ $setting->timezone == 'Asia/Barnaul' ? 'selected' : '' }} value="Asia/Barnaul" >Asia/Barnaul</option>
                <option {{ $setting->timezone == 'Asia/Beirut' ? 'selected' : '' }} value="Asia/Beirut" >Asia/Beirut</option>
                <option {{ $setting->timezone == 'Asia/Bishkek' ? 'selected' : '' }} value="Asia/Bishkek" >Asia/Bishkek</option>
                <option {{ $setting->timezone == 'Asia/Brunei' ? 'selected' : '' }} value="Asia/Brunei" >Asia/Brunei</option>
                <option {{ $setting->timezone == 'Asia/Chita' ? 'selected' : '' }} value="Asia/Chita" >Asia/Chita</option>
                <option {{ $setting->timezone == 'Asia/Choibalsan' ? 'selected' : '' }} value="Asia/Choibalsan" >Asia/Choibalsan</option>
                <option {{ $setting->timezone == 'Asia/Colombo' ? 'selected' : '' }} value="Asia/Colombo" >Asia/Colombo</option>
                <option {{ $setting->timezone == 'Asia/Damascus' ? 'selected' : '' }} value="Asia/Damascus" >Asia/Damascus</option>
                <option {{ $setting->timezone == 'Asia/Dhaka' ? 'selected' : '' }} value="Asia/Dhaka" >Asia/Dhaka</option>
                <option {{ $setting->timezone == 'Asia/Dili' ? 'selected' : '' }} value="Asia/Dili" >Asia/Dili</option>
                <option {{ $setting->timezone == 'Asia/Dubai' ? 'selected' : '' }} value="Asia/Dubai" >Asia/Dubai</option>
                <option {{ $setting->timezone == 'Asia/Dushanbe' ? 'selected' : '' }} value="Asia/Dushanbe" >Asia/Dushanbe</option>
                <option {{ $setting->timezone == 'Asia/Famagusta' ? 'selected' : '' }} value="Asia/Famagusta" >Asia/Famagusta</option>
                <option {{ $setting->timezone == 'Asia/Gaza' ? 'selected' : '' }} value="Asia/Gaza" >Asia/Gaza</option>
                <option {{ $setting->timezone == 'Asia/Hebron' ? 'selected' : '' }} value="Asia/Hebron" >Asia/Hebron</option>
                <option {{ $setting->timezone == 'Asia/Ho_Chi_Minh' ? 'selected' : '' }} value="Asia/Ho_Chi_Minh" >Asia/Ho_Chi_Minh</option>
                <option {{ $setting->timezone == 'Asia/Hong_Kong' ? 'selected' : '' }} value="Asia/Hong_Kong" >Asia/Hong_Kong</option>
                <option {{ $setting->timezone == 'Asia/Hovd' ? 'selected' : '' }} value="Asia/Hovd" >Asia/Hovd</option>
                <option {{ $setting->timezone == 'Asia/Irkutsk' ? 'selected' : '' }} value="Asia/Irkutsk" >Asia/Irkutsk</option>
                <option {{ $setting->timezone == 'Asia/Jakarta' ? 'selected' : '' }} value="Asia/Jakarta" >Asia/Jakarta</option>
                <option {{ $setting->timezone == 'Asia/Jayapura' ? 'selected' : '' }} value="Asia/Jayapura" >Asia/Jayapura</option>
                <option {{ $setting->timezone == 'Asia/Jerusalem' ? 'selected' : '' }} value="Asia/Jerusalem" >Asia/Jerusalem</option>
                <option {{ $setting->timezone == 'Asia/Kabul' ? 'selected' : '' }} value="Asia/Kabul" >Asia/Kabul</option>
                <option {{ $setting->timezone == 'Asia/Kamchatka' ? 'selected' : '' }} value="Asia/Kamchatka" >Asia/Kamchatka</option>
                <option {{ $setting->timezone == 'Asia/Karachi' ? 'selected' : '' }} value="Asia/Karachi" >Asia/Karachi</option>
                <option {{ $setting->timezone == 'Asia/Kathmandu' ? 'selected' : '' }} value="Asia/Kathmandu" >Asia/Kathmandu</option>
                <option {{ $setting->timezone == 'Asia/Khandyga' ? 'selected' : '' }} value="Asia/Khandyga" >Asia/Khandyga</option>
                <option {{ $setting->timezone == 'Asia/Kolkata' ? 'selected' : '' }} value="Asia/Kolkata" >Asia/Kolkata</option>
                <option {{ $setting->timezone == 'Asia/Krasnoyarsk' ? 'selected' : '' }} value="Asia/Krasnoyarsk" >Asia/Krasnoyarsk</option>
                <option {{ $setting->timezone == 'Asia/Kuala_Lumpur' ? 'selected' : '' }} value="Asia/Kuala_Lumpur" >Asia/Kuala_Lumpur</option>


                <option {{ $setting->timezone == 'Asia/Kuching' ? 'selected' : '' }} value="Asia/Kuching" >Asia/Kuching</option>
                <option {{ $setting->timezone == 'Asia/Kuwait' ? 'selected' : '' }} value="Asia/Kuwait" >Asia/Kuwait</option>
                <option {{ $setting->timezone == 'Asia/Macau' ? 'selected' : '' }} value="Asia/Macau" >Asia/Macau</option>
                <option {{ $setting->timezone == 'Asia/Magadan' ? 'selected' : '' }} value="Asia/Magadan" >Asia/Magadan</option>
                <option {{ $setting->timezone == 'Asia/Makassar' ? 'selected' : '' }} value="Asia/Makassar" >Asia/Makassar</option>
                <option {{ $setting->timezone == 'Asia/Manila' ? 'selected' : '' }} value="Asia/Manila" >Asia/Manila</option>
                <option {{ $setting->timezone == 'Asia/Muscat' ? 'selected' : '' }} value="Asia/Muscat" >Asia/Muscat</option>
                <option {{ $setting->timezone == 'Asia/Nicosia' ? 'selected' : '' }} value="Asia/Nicosia" >Asia/Nicosia</option>
                <option {{ $setting->timezone == 'Asia/Novokuznetsk' ? 'selected' : '' }} value="Asia/Novokuznetsk" >Asia/Novokuznetsk</option>
                <option {{ $setting->timezone == 'Asia/Novosibirsk' ? 'selected' : '' }} value="Asia/Novosibirsk" >Asia/Novosibirsk</option>
                <option {{ $setting->timezone == 'Asia/Omsk' ? 'selected' : '' }} value="Asia/Omsk" >Asia/Omsk</option>
                <option {{ $setting->timezone == 'Asia/Oral' ? 'selected' : '' }} value="Asia/Oral" >Asia/Oral</option>
                <option {{ $setting->timezone == 'Asia/Phnom_Penh' ? 'selected' : '' }} value="Asia/Phnom_Penh" >Asia/Phnom_Penh</option>
                <option {{ $setting->timezone == 'Asia/Pontianak' ? 'selected' : '' }} value="Asia/Pontianak" >Asia/Pontianak</option>
                <option {{ $setting->timezone == 'Asia/Pyongyang' ? 'selected' : '' }} value="Asia/Pyongyang" >Asia/Pyongyang</option>
                <option {{ $setting->timezone == 'Asia/Qatar' ? 'selected' : '' }} value="Asia/Qatar" >Asia/Qatar</option>
                <option {{ $setting->timezone == 'Asia/Qostanay' ? 'selected' : '' }} value="Asia/Qostanay" >Asia/Qostanay</option>
                <option {{ $setting->timezone == 'Asia/Qyzylorda' ? 'selected' : '' }} value="Asia/Qyzylorda" >Asia/Qyzylorda</option>
                <option {{ $setting->timezone == 'Asia/Riyadh' ? 'selected' : '' }} value="Asia/Riyadh" >Asia/Riyadh</option>
                <option {{ $setting->timezone == 'Asia/Sakhalin' ? 'selected' : '' }} value="Asia/Sakhalin" >Asia/Sakhalin</option>
                <option {{ $setting->timezone == 'Asia/Samarkand' ? 'selected' : '' }} value="Asia/Samarkand" >Asia/Samarkand</option>
                <option {{ $setting->timezone == 'Asia/Seoul' ? 'selected' : '' }} value="Asia/Seoul" >Asia/Seoul</option>
                <option {{ $setting->timezone == 'Asia/Shanghai' ? 'selected' : '' }} value="Asia/Shanghai" >Asia/Shanghai</option>
                <option {{ $setting->timezone == 'Asia/Singapore' ? 'selected' : '' }} value="Asia/Singapore" >Asia/Singapore</option>
                <option {{ $setting->timezone == 'Asia/Srednekolymsk' ? 'selected' : '' }} value="Asia/Srednekolymsk" >Asia/Srednekolymsk</option>
                <option {{ $setting->timezone == 'Asia/Taipei' ? 'selected' : '' }} value="Asia/Taipei" >Asia/Taipei</option>
                <option {{ $setting->timezone == 'Asia/Tashkent' ? 'selected' : '' }} value="Asia/Tashkent" >Asia/Tashkent</option>
                <option {{ $setting->timezone == 'Asia/Tbilisi' ? 'selected' : '' }} value="Asia/Tbilisi" >Asia/Tbilisi</option>
                <option {{ $setting->timezone == 'Asia/Tehran' ? 'selected' : '' }} value="Asia/Tehran" >Asia/Tehran</option>
                <option {{ $setting->timezone == 'Asia/Thimphu' ? 'selected' : '' }} value="Asia/Thimphu" >Asia/Thimphu</option>
                <option {{ $setting->timezone == 'Asia/Tokyo' ? 'selected' : '' }} value="Asia/Tokyo" >Asia/Tokyo</option>


                <option {{ $setting->timezone == 'Asia/Tomsk' ? 'selected' : '' }} value="Asia/Tomsk" >Asia/Tomsk</option>
                <option {{ $setting->timezone == 'Asia/Ulaanbaatar' ? 'selected' : '' }}  value="Asia/Ulaanbaatar" >Asia/Ulaanbaatar</option>
                <option {{ $setting->timezone == 'Asia/Urumqi' ? 'selected' : '' }}  value="Asia/Urumqi" >Asia/Urumqi</option>
                <option {{ $setting->timezone == 'Asia/Ust-Nera' ? 'selected' : '' }}  value="Asia/Ust-Nera" >Asia/Ust-Nera</option>
                <option {{ $setting->timezone == 'Asia/Vientiane' ? 'selected' : '' }}  value="Asia/Vientiane" >Asia/Vientiane</option>
                <option {{ $setting->timezone == 'Asia/Vladivostok' ? 'selected' : '' }}  value="Asia/Vladivostok" >Asia/Vladivostok</option>
                <option {{ $setting->timezone == 'Asia/Yakutsk' ? 'selected' : '' }}  value="Asia/Yakutsk" >Asia/Yakutsk</option>
                <option {{ $setting->timezone == 'Asia/Yangon' ? 'selected' : '' }}  value="Asia/Yangon" >Asia/Yangon</option>
                <option {{ $setting->timezone == 'Asia/Yekaterinburg' ? 'selected' : '' }}  value="Asia/Yekaterinburg" >Asia/Yekaterinburg</option>
                <option {{ $setting->timezone == 'Asia/Yerevan' ? 'selected' : '' }}  value="Asia/Yerevan" >Asia/Yerevan</option>
                <option {{ $setting->timezone == 'Atlantic/Azores' ? 'selected' : '' }}  value="Atlantic/Azores" >Atlantic/Azores</option>
                <option {{ $setting->timezone == 'Atlantic/Bermuda' ? 'selected' : '' }}  value="Atlantic/Bermuda" >Atlantic/Bermuda</option>
                <option {{ $setting->timezone == 'Atlantic/Canary' ? 'selected' : '' }}  value="Atlantic/Canary" >Atlantic/Canary</option>
                <option {{ $setting->timezone == 'Atlantic/Cape_Verde' ? 'selected' : '' }}  value="Atlantic/Cape_Verde" >Atlantic/Cape_Verde</option>
                <option {{ $setting->timezone == 'Atlantic/Faroe' ? 'selected' : '' }}  value="Atlantic/Faroe" >Atlantic/Faroe</option>
                <option {{ $setting->timezone == 'Atlantic/Madeira' ? 'selected' : '' }}  value="Atlantic/Madeira" >Atlantic/Madeira</option>
                <option {{ $setting->timezone == 'Atlantic/Reykjavik' ? 'selected' : '' }}  value="Atlantic/Reykjavik" >Atlantic/Reykjavik</option>
                <option {{ $setting->timezone == 'Atlantic/South_Georgia' ? 'selected' : '' }}  value="Atlantic/South_Georgia" >Atlantic/South_Georgia</option>
                <option {{ $setting->timezone == 'Atlantic/St_Helena' ? 'selected' : '' }}  value="Atlantic/St_Helena" >Atlantic/St_Helena</option>
                <option {{ $setting->timezone == 'Atlantic/Stanley' ? 'selected' : '' }}  value="Atlantic/Stanley" >Atlantic/Stanley</option>
                <option {{ $setting->timezone == 'Australia/Adelaide' ? 'selected' : '' }}  value="Australia/Adelaide" >Australia/Adelaide</option>
                <option {{ $setting->timezone == 'Australia/Brisbane' ? 'selected' : '' }}  value="Australia/Brisbane" >Australia/Brisbane</option>
                <option {{ $setting->timezone == 'Australia/Broken_Hill' ? 'selected' : '' }}  value="Australia/Broken_Hill" >Australia/Broken_Hill</option>
                <option {{ $setting->timezone == 'Australia/Darwin' ? 'selected' : '' }}  value="Australia/Darwin" >Australia/Darwin</option>
                <option {{ $setting->timezone == 'Australia/Eucla' ? 'selected' : '' }}  value="Australia/Eucla" >Australia/Eucla</option>
                <option {{ $setting->timezone == 'Australia/Hobart' ? 'selected' : '' }}  value="Australia/Hobart" >Australia/Hobart</option>
                <option {{ $setting->timezone == 'Australia/Lindeman' ? 'selected' : '' }}  value="Australia/Lindeman" >Australia/Lindeman</option>
                <option {{ $setting->timezone == 'Australia/Lord_Howe' ? 'selected' : '' }}  value="Australia/Lord_Howe" >Australia/Lord_Howe</option>
                <option {{ $setting->timezone == 'Australia/Melbourne' ? 'selected' : '' }}  value="Australia/Melbourne" >Australia/Melbourne</option>
                <option {{ $setting->timezone == 'Australia/Perth' ? 'selected' : '' }}  value="Australia/Perth" >Australia/Perth</option>

                <option {{ $setting->timezone == 'Australia/Sydney' ? 'selected' : '' }} value="Australia/Sydney" >Australia/Sydney</option>
                <option {{ $setting->timezone == 'Europe/Amsterdam' ? 'selected' : '' }} value="Europe/Amsterdam" >Europe/Amsterdam</option>
                <option {{ $setting->timezone == 'Europe/Andorra' ? 'selected' : '' }} value="Europe/Andorra" >Europe/Andorra</option>
                <option {{ $setting->timezone == 'Europe/Astrakhan' ? 'selected' : '' }} value="Europe/Astrakhan" >Europe/Astrakhan</option>
                <option {{ $setting->timezone == 'Europe/Athens' ? 'selected' : '' }} value="Europe/Athens" >Europe/Athens</option>
                <option {{ $setting->timezone == 'Europe/Belgrade' ? 'selected' : '' }} value="Europe/Belgrade" >Europe/Belgrade</option>
                <option {{ $setting->timezone == 'Europe/Berlin' ? 'selected' : '' }} value="Europe/Berlin" >Europe/Berlin</option>
                <option {{ $setting->timezone == 'Europe/Bratislava' ? 'selected' : '' }} value="Europe/Bratislava" >Europe/Bratislava</option>
                <option {{ $setting->timezone == 'Europe/Brussels' ? 'selected' : '' }} value="Europe/Brussels" >Europe/Brussels</option>
                <option {{ $setting->timezone == 'Europe/Bucharest' ? 'selected' : '' }} value="Europe/Bucharest" >Europe/Bucharest</option>
                <option {{ $setting->timezone == 'Europe/Budapest' ? 'selected' : '' }} value="Europe/Budapest" >Europe/Budapest</option>
                <option {{ $setting->timezone == 'Europe/Busingen' ? 'selected' : '' }} value="Europe/Busingen" >Europe/Busingen</option>
                <option {{ $setting->timezone == 'Europe/Chisinau' ? 'selected' : '' }} value="Europe/Chisinau" >Europe/Chisinau</option>
                <option {{ $setting->timezone == 'Europe/Copenhagen' ? 'selected' : '' }} value="Europe/Copenhagen" >Europe/Copenhagen</option>
                <option {{ $setting->timezone == 'Europe/Dublin' ? 'selected' : '' }} value="Europe/Dublin" >Europe/Dublin</option>
                <option {{ $setting->timezone == 'Europe/Gibraltar' ? 'selected' : '' }} value="Europe/Gibraltar" >Europe/Gibraltar</option>
                <option {{ $setting->timezone == 'Europe/Guernsey' ? 'selected' : '' }} value="Europe/Guernsey" >Europe/Guernsey</option>
                <option {{ $setting->timezone == 'Europe/Helsinki' ? 'selected' : '' }} value="Europe/Helsinki" >Europe/Helsinki</option>
                <option {{ $setting->timezone == 'Europe/Isle_of_Man' ? 'selected' : '' }} value="Europe/Isle_of_Man" >Europe/Isle_of_Man</option>
                <option {{ $setting->timezone == 'Europe/Istanbul' ? 'selected' : '' }} value="Europe/Istanbul" >Europe/Istanbul</option>
                <option {{ $setting->timezone == 'Europe/Jersey' ? 'selected' : '' }} value="Europe/Jersey" >Europe/Jersey</option>
                <option {{ $setting->timezone == 'Europe/Kaliningrad' ? 'selected' : '' }} value="Europe/Kaliningrad" >Europe/Kaliningrad</option>
                <option {{ $setting->timezone == 'Europe/Kiev' ? 'selected' : '' }} value="Europe/Kiev" >Europe/Kiev</option>
                <option {{ $setting->timezone == 'Europe/Kirov' ? 'selected' : '' }} value="Europe/Kirov" >Europe/Kirov</option>
                <option {{ $setting->timezone == 'Europe/Lisbon' ? 'selected' : '' }} value="Europe/Lisbon" >Europe/Lisbon</option>
                <option {{ $setting->timezone == 'Europe/Ljubljana' ? 'selected' : '' }} value="Europe/Ljubljana" >Europe/Ljubljana</option>
                <option {{ $setting->timezone == 'Europe/London' ? 'selected' : '' }} value="Europe/London" >Europe/London</option>
                <option {{ $setting->timezone == 'Europe/Luxembourg' ? 'selected' : '' }} value="Europe/Luxembourg" >Europe/Luxembourg</option>
                <option {{ $setting->timezone == 'Europe/Madrid' ? 'selected' : '' }} value="Europe/Madrid" >Europe/Madrid</option>
                <option {{ $setting->timezone == 'Europe/Malta' ? 'selected' : '' }} value="Europe/Malta" >Europe/Malta</option>
                <option {{ $setting->timezone == 'Europe/Mariehamn' ? 'selected' : '' }} value="Europe/Mariehamn" >Europe/Mariehamn</option>

                <option {{ $setting->timezone == 'Europe/Minsk' ? 'selected' : '' }} value="Europe/Minsk" >Europe/Minsk</option>
                <option {{ $setting->timezone == 'Europe/Monaco' ? 'selected' : '' }} value="Europe/Monaco" >Europe/Monaco</option>
                <option {{ $setting->timezone == 'Europe/Moscow' ? 'selected' : '' }} value="Europe/Moscow" >Europe/Moscow</option>
                <option {{ $setting->timezone == 'Europe/Oslo' ? 'selected' : '' }} value="Europe/Oslo" >Europe/Oslo</option>
                <option {{ $setting->timezone == 'Europe/Paris' ? 'selected' : '' }} value="Europe/Paris" >Europe/Paris</option>
                <option {{ $setting->timezone == 'Europe/Podgorica' ? 'selected' : '' }} value="Europe/Podgorica" >Europe/Podgorica</option>
                <option {{ $setting->timezone == 'Europe/Prague' ? 'selected' : '' }} value="Europe/Prague" >Europe/Prague</option>
                <option {{ $setting->timezone == 'Europe/Riga' ? 'selected' : '' }} value="Europe/Riga" >Europe/Riga</option>
                <option {{ $setting->timezone == 'Europe/Rome' ? 'selected' : '' }} value="Europe/Rome" >Europe/Rome</option>
                <option {{ $setting->timezone == 'Europe/Samara' ? 'selected' : '' }} value="Europe/Samara" >Europe/Samara</option>
                <option {{ $setting->timezone == 'Europe/San_Marino' ? 'selected' : '' }} value="Europe/San_Marino" >Europe/San_Marino</option>
                <option {{ $setting->timezone == 'Europe/Sarajevo' ? 'selected' : '' }} value="Europe/Sarajevo" >Europe/Sarajevo</option>
                <option {{ $setting->timezone == 'Europe/Saratov' ? 'selected' : '' }} value="Europe/Saratov" >Europe/Saratov</option>
                <option {{ $setting->timezone == 'Europe/Simferopol' ? 'selected' : '' }} value="Europe/Simferopol" >Europe/Simferopol</option>
                <option {{ $setting->timezone == 'Europe/Skopje' ? 'selected' : '' }} value="Europe/Skopje" >Europe/Skopje</option>
                <option {{ $setting->timezone == 'Europe/Sofia' ? 'selected' : '' }} value="Europe/Sofia" >Europe/Sofia</option>
                <option {{ $setting->timezone == 'Europe/Stockholm' ? 'selected' : '' }} value="Europe/Stockholm" >Europe/Stockholm</option>
                <option {{ $setting->timezone == 'Europe/Tallinn' ? 'selected' : '' }} value="Europe/Tallinn" >Europe/Tallinn</option>
                <option {{ $setting->timezone == 'Europe/Tirane' ? 'selected' : '' }} value="Europe/Tirane" >Europe/Tirane</option>
                <option {{ $setting->timezone == 'Europe/Ulyanovsk' ? 'selected' : '' }} value="Europe/Ulyanovsk" >Europe/Ulyanovsk</option>
                <option {{ $setting->timezone == 'Europe/Uzhgorod' ? 'selected' : '' }} value="Europe/Uzhgorod" >Europe/Uzhgorod</option>
                <option {{ $setting->timezone == 'Europe/Vaduz' ? 'selected' : '' }} value="Europe/Vaduz" >Europe/Vaduz</option>
                <option {{ $setting->timezone == 'Europe/Vatican' ? 'selected' : '' }} value="Europe/Vatican" >Europe/Vatican</option>
                <option {{ $setting->timezone == 'Europe/Vienna' ? 'selected' : '' }} value="Europe/Vienna" >Europe/Vienna</option>
                <option {{ $setting->timezone == 'Europe/Vilnius' ? 'selected' : '' }} value="Europe/Vilnius" >Europe/Vilnius</option>
                <option {{ $setting->timezone == 'Europe/Volgograd' ? 'selected' : '' }} value="Europe/Volgograd" >Europe/Volgograd</option>
                <option {{ $setting->timezone == 'Europe/Warsaw' ? 'selected' : '' }} value="Europe/Warsaw" >Europe/Warsaw</option>
                <option {{ $setting->timezone == 'Europe/Zagreb' ? 'selected' : '' }} value="Europe/Zagreb" >Europe/Zagreb</option>
                <option {{ $setting->timezone == 'Europe/Zaporozhye' ? 'selected' : '' }} value="Europe/Zaporozhye" >Europe/Zaporozhye</option>
                <option {{ $setting->timezone == 'Europe/Zurich' ? 'selected' : '' }} value="Europe/Zurich" >Europe/Zurich</option>
                <option {{ $setting->timezone == 'Indian/Antananarivo' ? 'selected' : '' }} value="Indian/Antananarivo" >Indian/Antananarivo</option>
                <option {{ $setting->timezone == 'Indian/Chagos' ? 'selected' : '' }} value="Indian/Chagos" >Indian/Chagos</option>

                <option  {{ $setting->timezone == 'Indian/Christmas' ? 'selected' : '' }} value="Indian/Christmas" >Indian/Christmas</option>
                <option  {{ $setting->timezone == 'Indian/Cocos' ? 'selected' : '' }} value="Indian/Cocos" >Indian/Cocos</option>
                <option  {{ $setting->timezone == 'Indian/Comoro' ? 'selected' : '' }} value="Indian/Comoro" >Indian/Comoro</option>
                <option  {{ $setting->timezone == 'Indian/Kerguelen' ? 'selected' : '' }} value="Indian/Kerguelen" >Indian/Kerguelen</option>
                <option  {{ $setting->timezone == 'Indian/Mahe' ? 'selected' : '' }} value="Indian/Mahe" >Indian/Mahe</option>
                <option  {{ $setting->timezone == 'Indian/Maldives' ? 'selected' : '' }} value="Indian/Maldives" >Indian/Maldives</option>
                <option  {{ $setting->timezone == 'Indian/Mauritius' ? 'selected' : '' }} value="Indian/Mauritius" >Indian/Mauritius</option>
                <option  {{ $setting->timezone == 'Indian/Mayotte' ? 'selected' : '' }} value="Indian/Mayotte" >Indian/Mayotte</option>
                <option  {{ $setting->timezone == 'Indian/Reunion' ? 'selected' : '' }} value="Indian/Reunion" >Indian/Reunion</option>
                <option  {{ $setting->timezone == 'Pacific/Apia' ? 'selected' : '' }} value="Pacific/Apia" >Pacific/Apia</option>
                <option  {{ $setting->timezone == 'Pacific/Auckland' ? 'selected' : '' }} value="Pacific/Auckland" >Pacific/Auckland</option>
                <option  {{ $setting->timezone == 'Pacific/Bougainville' ? 'selected' : '' }} value="Pacific/Bougainville" >Pacific/Bougainville</option>
                <option  {{ $setting->timezone == 'Pacific/Chatham' ? 'selected' : '' }} value="Pacific/Chatham" >Pacific/Chatham</option>
                <option  {{ $setting->timezone == 'Pacific/Chuuk' ? 'selected' : '' }} value="Pacific/Chuuk" >Pacific/Chuuk</option>
                <option  {{ $setting->timezone == 'Pacific/Easter' ? 'selected' : '' }} value="Pacific/Easter" >Pacific/Easter</option>
                <option  {{ $setting->timezone == 'Pacific/Efate' ? 'selected' : '' }} value="Pacific/Efate" >Pacific/Efate</option>
                <option  {{ $setting->timezone == 'Pacific/Enderbury' ? 'selected' : '' }} value="Pacific/Enderbury" >Pacific/Enderbury</option>
                <option  {{ $setting->timezone == 'Pacific/Fakaofo' ? 'selected' : '' }} value="Pacific/Fakaofo" >Pacific/Fakaofo</option>
                <option  {{ $setting->timezone == 'Pacific/Fiji' ? 'selected' : '' }} value="Pacific/Fiji" >Pacific/Fiji</option>
                <option  {{ $setting->timezone == 'Pacific/Funafuti' ? 'selected' : '' }} value="Pacific/Funafuti" >Pacific/Funafuti</option>
                <option  {{ $setting->timezone == 'Pacific/Galapagos' ? 'selected' : '' }} value="Pacific/Galapagos" >Pacific/Galapagos</option>
                <option  {{ $setting->timezone == 'Pacific/Gambier' ? 'selected' : '' }} value="Pacific/Gambier" >Pacific/Gambier</option>
                <option  {{ $setting->timezone == 'Pacific/Guadalcanal' ? 'selected' : '' }} value="Pacific/Guadalcanal" >Pacific/Guadalcanal</option>
                <option  {{ $setting->timezone == 'Pacific/Guam' ? 'selected' : '' }} value="Pacific/Guam" >Pacific/Guam</option>
                <option  {{ $setting->timezone == 'Pacific/Honolulu' ? 'selected' : '' }} value="Pacific/Honolulu" >Pacific/Honolulu</option>
                <option  {{ $setting->timezone == 'Pacific/Kiritimati' ? 'selected' : '' }} value="Pacific/Kiritimati" >Pacific/Kiritimati</option>
                <option  {{ $setting->timezone == 'Pacific/Kosrae' ? 'selected' : '' }} value="Pacific/Kosrae" >Pacific/Kosrae</option>
                <option  {{ $setting->timezone == 'Pacific/Kwajalein' ? 'selected' : '' }} value="Pacific/Kwajalein" >Pacific/Kwajalein</option>
                <option  {{ $setting->timezone == 'Pacific/Majuro' ? 'selected' : '' }} value="Pacific/Majuro" >Pacific/Majuro</option>
                <option  {{ $setting->timezone == 'Pacific/Marquesas' ? 'selected' : '' }} value="Pacific/Marquesas" >Pacific/Marquesas</option>
                <option  {{ $setting->timezone == 'Pacific/Midway' ? 'selected' : '' }} value="Pacific/Midway" >Pacific/Midway</option>
                <option  {{ $setting->timezone == 'Pacific/Nauru' ? 'selected' : '' }} value="Pacific/Nauru" >Pacific/Nauru</option>
                <option  {{ $setting->timezone == 'IPacific/Niue' ? 'selected' : '' }} value="Pacific/Niue" >Pacific/Niue</option>
                <option  {{ $setting->timezone == 'Pacific/Norfolk' ? 'selected' : '' }} value="Pacific/Norfolk" >Pacific/Norfolk</option>
                <option  {{ $setting->timezone == 'Pacific/Noumea' ? 'selected' : '' }} value="Pacific/Noumea" >Pacific/Noumea</option>
                <option  {{ $setting->timezone == 'Pacific/Pago_Pago' ? 'selected' : '' }} value="Pacific/Pago_Pago" >Pacific/Pago_Pago</option>
                <option  {{ $setting->timezone == 'Pacific/Palau' ? 'selected' : '' }} value="Pacific/Palau" >Pacific/Palau</option>
                <option  {{ $setting->timezone == 'Pacific/Pitcairn' ? 'selected' : '' }} value="Pacific/Pitcairn" >Pacific/Pitcairn</option>
                <option  {{ $setting->timezone == 'Pacific/Pohnpei' ? 'selected' : '' }} value="Pacific/Pohnpei" >Pacific/Pohnpei</option>
                <option  {{ $setting->timezone == 'Pacific/Port_Moresby' ? 'selected' : '' }} value="Pacific/Port_Moresby" >Pacific/Port_Moresby</option>
                <option  {{ $setting->timezone == 'Pacific/Rarotonga' ? 'selected' : '' }} value="Pacific/Rarotonga" >Pacific/Rarotonga</option>
                <option  {{ $setting->timezone == 'Pacific/Saipan' ? 'selected' : '' }} value="Pacific/Saipan" >Pacific/Saipan</option>
                <option  {{ $setting->timezone == 'Pacific/Tahiti' ? 'selected' : '' }} value="Pacific/Tahiti" >Pacific/Tahiti</option>
                <option  {{ $setting->timezone == 'Pacific/Tarawa' ? 'selected' : '' }} value="Pacific/Tarawa" >Pacific/Tarawa</option>
                <option  {{ $setting->timezone == 'Pacific/Tongatapu' ? 'selected' : '' }} value="Pacific/Tongatapu" >Pacific/Tongatapu</option>
                <option  {{ $setting->timezone == 'Pacific/Wake' ? 'selected' : '' }} value="Pacific/Wake" >Pacific/Wake</option>
                <option  {{ $setting->timezone == 'Pacific/Wallis' ? 'selected' : '' }} value="Pacific/Wallis" >Pacific/Wallis</option>
                <option  {{ $setting->timezone == 'UTC' ? 'selected' : '' }} value="UTC" >UTC</option>
            </select>
        </div>


                        <button type="submit" class="btn btn-success">{{ $websiteLang->where('lang_key','update')->first()->custom_text }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection



