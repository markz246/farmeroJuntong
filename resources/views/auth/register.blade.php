@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-users"></i>
                    {{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                            <div class="col-md-6">
                                <input id="contact" type="text" placeholder="ex: 09123456789" maxlength="11" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact" autofocus>

                                @error('contact')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-3">
                                <input id="address_street" type="text" placeholder="Street" class="form-control @error('address_street') is-invalid @enderror" name="address_street" value="{{ old('address_street') }}" required autocomplete="address_street" autofocus>

                                @error('address_street')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <input id="address_barangay" type="text" placeholder="Barangay" class="form-control @error('address_barangay') is-invalid @enderror" name="address_barangay" value="{{ old('address_barangay') }}" required autocomplete="address_barangay" autofocus>

                                @error('address_barangay')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-3">
                                <input id="address_city" type="text" placeholder="City" class="form-control @error('address_city') is-invalid @enderror" name="address_city" value="{{ old('address_city') }}" required autocomplete="address_city" autofocus>

                                @error('address_city')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <select id="address_province" type="text" placeholder="Province" class="form-control @error('address_province') is-invalid @enderror" name="address_province" value="{{ old('address_province') }}" required autocomplete="address_province" autofocus>
                                    <option selected disabled>Province</option>
                                    <option value="PH-ABR">Abra</option>
                                    <option value="PH-AGN">Agusan del Norte</option>
                                    <option value="PH-AGS">Agusan del Sur</option>
                                    <option value="PH-AKL">Aklan</option>
                                    <option value="PH-ALB">Albay</option>
                                    <option value="PH-ANT">Antique</option>
                                    <option value="PH-APA">Apayao</option>
                                    <option value="PH-AUR">Aurora</option>
                                    <option value="PH-BAS">Basilan</option>
                                    <option value="PH-BAN">Bataan</option>
                                    <option value="PH-BTN">Batanes</option>
                                    <option value="PH-BTG">Batangas</option>
                                    <option value="PH-BEN">Benguet</option>
                                    <option value="PH-BIL">Biliran</option>
                                    <option value="PH-BOH">Bohol</option>
                                    <option value="PH-BUK">Bukidnon</option>
                                    <option value="PH-BUL">Bulacan</option>
                                    <option value="PH-CAG">Cagayan</option>
                                    <option value="PH-CAN">Camarines Norte</option>
                                    <option value="PH-CAS">Camarines Sur</option>
                                    <option value="PH-CAM">Camiguin</option>
                                    <option value="PH-CAP">Capiz</option>
                                    <option value="PH-CAT">Catanduanes</option>
                                    <option value="PH-CAV">Cavite</option>
                                    <option value="PH-CEB">Cebu</option>
                                    <option value="PH-COM">Compostela Valley</option>
                                    <option value="PH-NCO">Cotabato</option>
                                    <option value="PH-DAV">Davao del Norte</option>
                                    <option value="PH-DAS">Davao del Sur</option>
                                    <option value="PH-DVO">Davao Occidental</option>
                                    <option value="PH-DAO">Davao Oriental</option>
                                    <option value="PH-DIN">Dinagat Islands</option>
                                    <option value="PH-EAS">Eastern Samar</option>
                                    <option value="PH-GUI">Guimaras</option>
                                    <option value="PH-IFU">Ifugao</option>
                                    <option value="PH-ILN">Ilocos Norte</option>
                                    <option value="PH-ILS">Ilocos Sur</option>
                                    <option value="PH-ILI">Iloilo</option>
                                    <option value="PH-ISA">Isabela</option>
                                    <option value="PH-KAL">Kalinga</option>
                                    <option value="PH-LUN">La Union</option>
                                    <option value="PH-LAG">Laguna</option>
                                    <option value="PH-LAN">Lanao del Norte</option>
                                    <option value="PH-LAS">Lanao del Sur</option>
                                    <option value="PH-LEY">Leyte</option>
                                    <option value="PH-MAG">Maguindanao</option>
                                    <option value="PH-MAD">Marinduque</option>
                                    <option value="PH-MAS">Masbate</option>
                                    <option value="PH-MDC">Mindoro Occidental</option>
                                    <option value="PH-MDR">Mindoro Oriental</option>
                                    <option value="PH-MSC">Misamis Occidental</option>
                                    <option value="PH-MSR">Misamis Oriental</option>
                                    <option value="PH-MOU">Mountain Province</option>
                                    <option value="PH-NEC">Negros Occidental</option>
                                    <option value="PH-NER">Negros Oriental</option>
                                    <option value="PH-NSA">Northern Samar</option>
                                    <option value="PH-NUE">Nueva Ecija</option>
                                    <option value="PH-NUV">Nueva Vizcaya</option>
                                    <option value="PH-PLW">Palawan</option>
                                    <option value="PH-PAM">Pampanga</option>
                                    <option value="PH-PAN">Pangasinan</option>
                                    <option value="PH-QUE">Quezon</option>
                                    <option value="PH-QUI">Quirino</option>
                                    <option value="PH-RIZ">Rizal</option>
                                    <option value="PH-ROM">Romblon</option>
                                    <option value="PH-WSA">Samar (Western Samar)</option>
                                    <option value="PH-SAR">Sarangani</option>
                                    <option value="PH-SIG">Siquijor</option>
                                    <option value="PH-SOR">Sorsogon</option>
                                    <option value="PH-SCO">South Cotabato</option>
                                    <option value="PH-SLE">Southern Leyte</option>
                                    <option value="PH-SUK">Sultan Kudarat</option>
                                    <option value="PH-SLU">Sulu</option>
                                    <option value="PH-SUN">Surigao del Norte</option>
                                    <option value="PH-SUR">Surigao del Sur</option>
                                    <option value="PH-TAR">Tarlac</option>
                                    <option value="PH-TAW">Tawi-Tawi</option>
                                    <option value="PH-ZMB">Zambales</option>
                                    <option value="PH-ZAN">Zamboanga del Norte</option>
                                    <option value="PH-ZAS">Zamboanga del Sur</option>
                                    <option value="PH-ZSI">Zamboanga Sibugay</option>
                                </select>
                                @error('address_province')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
