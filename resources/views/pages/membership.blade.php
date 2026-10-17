{{-- Page Heading (Matches Contact & District Body page style) --}}
<header class="membership-page-heading">
    <h1>Join <span>(Online Membership)</span></h1>
    <p>{{ $page['subtitle'] ?? 'Become a part of Pakistan Peoples Party District Dadu and contribute to the progress, peace and prosperity of our society.' }}</p>
</header>

<div class="membership-layout">
    {{-- Left Sidebar: Why Join PPP / Principles --}}
    <aside class="membership-benefits-panel" aria-labelledby="membership-benefits-title">
        <h2 id="membership-benefits-title"><span>Why</span> Join PPP?</h2>
        <p class="membership-benefits-intro">
            Join Pakistan Peoples Party Today! Join hands with Pakistan Peoples Party District Dadu to serve the community, uphold democratic values, and build a progressive society.
        </p>

        <ul>
            @forelse (($page['principles'] ?? []) as $principle)
                <li>
                    <span class="membership-benefit-icon"><i class="fa-solid {{ $principle['icon'] ?? 'fa-circle-check' }}" aria-hidden="true"></i></span>
                    <div>
                        <strong>{{ $principle['title'] }}</strong>
                        <small>{{ $principle['description'] }}</small>
                    </div>
                </li>
            @empty
                <li>
                    <span class="membership-benefit-icon"><i class="fa-solid fa-people-group" aria-hidden="true"></i></span>
                    <div>
                        <strong>Be a Part of Change</strong>
                        <small>Join a legacy of leadership, sacrifice and democracy.</small>
                    </div>
                </li>
                <li>
                    <span class="membership-benefit-icon"><i class="fa-solid fa-bullhorn" aria-hidden="true"></i></span>
                    <div>
                        <strong>Raise Your Voice</strong>
                        <small>Share your views and shape a better tomorrow.</small>
                    </div>
                </li>
                <li>
                    <span class="membership-benefit-icon"><i class="fa-solid fa-handshake-angle" aria-hidden="true"></i></span>
                    <div>
                        <strong>Work for the People</strong>
                        <small>Serve your community and stand for social justice.</small>
                    </div>
                </li>
                <li>
                    <span class="membership-benefit-icon"><i class="fa-solid fa-arrow-trend-up" aria-hidden="true"></i></span>
                    <div>
                        <strong>Build a Stronger Future</strong>
                        <small>Work together for a peaceful, progressive Pakistan.</small>
                    </div>
                </li>
                <li>
                    <span class="membership-benefit-icon"><i class="fa-solid fa-address-card" aria-hidden="true"></i></span>
                    <div>
                        <strong>Official Membership Card</strong>
                        <small>Get your verified party membership card upon approval.</small>
                    </div>
                </li>
            @endforelse
        </ul>

        <div class="membership-help-card">
            <div class="d-flex align-items-center gap-2 mb-1">
                <i class="fa-solid fa-circle-question text-success"></i>
                <strong class="text-dark" style="font-size: 11px;">Need Assistance?</strong>
            </div>
            <p class="mb-0 text-secondary" style="font-size: 10px;">
                Have questions or need help? Visit our <a href="{{ route('pages.contact') }}" class="text-dark fw-bold text-decoration-underline">Contact Page</a>.
            </p>
        </div>
    </aside>

    {{-- Right Section: Online Membership Form Panel --}}
    <section class="form-panel membership-form-panel" aria-labelledby="membership-form-title">
        <h2 id="membership-form-title"><span>Join</span> Pakistan Peoples Party Today!</h2>

        <form action="{{ route('pages.join.store') }}" method="POST" enctype="multipart/form-data" id="membershipPortalForm" novalidate>
            @csrf

            <div class="row g-3">
                {{-- Row 1: Member Type & Gender --}}
                <div class="col-md-6">
                    <label class="form-label" for="member_type">
                        Member Type <span class="urdu-label">(ممبری قسم)</span> <span class="text-danger">*</span>
                    </label>
                    <select class="form-select membership-control" id="member_type" name="member_type" required>
                        <option value="" {{ old('member_type') ? '' : 'selected' }}>Select</option>
                        <option value="Primary Member" {{ old('member_type') === 'Primary Member' ? 'selected' : '' }}>Primary Member (بنیادی رکن)</option>
                        <option value="General Member" {{ old('member_type') === 'General Member' ? 'selected' : '' }}>General Member (عام رکن)</option>
                        <option value="Youth Wing" {{ old('member_type') === 'Youth Wing' ? 'selected' : '' }}>Youth Wing (یوتھ ونگ)</option>
                        <option value="Women Wing" {{ old('member_type') === 'Women Wing' ? 'selected' : '' }}>Women Wing (خواتین ونگ)</option>
                        <option value="Labour Wing" {{ old('member_type') === 'Labour Wing' ? 'selected' : '' }}>Labour Wing (لیبر ونگ)</option>
                        <option value="Peoples Student Federation" {{ old('member_type') === 'Peoples Student Federation' ? 'selected' : '' }}>Peoples Student Federation (طلبہ ونگ)</option>
                        <option value="Lawyers Forum" {{ old('member_type') === 'Lawyers Forum' ? 'selected' : '' }}>Lawyers Forum (وکلاء فورم)</option>
                        <option value="Overseas Member" {{ old('member_type') === 'Overseas Member' ? 'selected' : '' }}>Overseas Member (اوورسیز رکن)</option>
                        <option value="Other" {{ old('member_type') === 'Other' ? 'selected' : '' }}>Other (دیگر)</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="gender">
                        Gender <span class="urdu-label">(جنس)</span> <span class="text-danger">*</span>
                    </label>
                    <select class="form-select membership-control" id="gender" name="gender" required>
                        <option value="" {{ old('gender') ? '' : 'selected' }}>Select</option>
                        <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>Male (مرد)</option>
                        <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female (عورت)</option>
                        <option value="Other" {{ old('gender') === 'Other' ? 'selected' : '' }}>Other (دیگر)</option>
                    </select>
                </div>

                {{-- Row 2: Profile Picture --}}
                <div class="col-md-6">
                    <label class="form-label" for="profile_picture">
                        Profile Picture <span class="urdu-label">(پروفائل کی تصویر)</span> <span class="text-danger">*</span>
                    </label>
                    <input type="file" class="form-control membership-control" id="profile_picture" name="profile_picture" accept="image/*" required>
                </div>
                <div class="col-md-6 d-none d-md-block">
                    {{-- Empty column to maintain balance --}}
                </div>

                {{-- Row 3: First Name & Last Name --}}
                <div class="col-md-6">
                    <label class="form-label" for="first_name">
                        First Name <span class="urdu-label">(پہلا نام)</span> <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control membership-control" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="Enter" maxlength="100" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="last_name">
                        Last Name <span class="urdu-label">(آخری نام)</span> <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control membership-control" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Enter" maxlength="100" required>
                </div>

                {{-- Row 4: Email Address & Mobile Number --}}
                <div class="col-md-6">
                    <label class="form-label" for="email_address">
                        Email Address <span class="urdu-label">(*ای میل ایڈریس)</span> <span class="text-danger">*</span>
                    </label>
                    <input type="email" class="form-control membership-control" id="email_address" name="email_address" value="{{ old('email_address') }}" placeholder="Enter" maxlength="255" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="mobile_number">
                        Mobile Number <span class="urdu-label">(موبائل نمبر)</span> <span class="text-danger">*</span>
                    </label>
                    <input type="tel" class="form-control membership-control" id="mobile_number" name="mobile_number" value="{{ old('mobile_number', '03') }}" placeholder="03" maxlength="30" required>
                </div>

                {{-- Row 5: National Identity Card Number & Date of Birth --}}
                <div class="col-md-6">
                    <label class="form-label" for="cnic_number">
                        National Identity Card Number <span class="urdu-label">(شناختی کارڈ نمبر)</span> <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control membership-control" id="cnic_number" name="cnic_number" value="{{ old('cnic_number') }}" placeholder="XXXXX-1234567-X" pattern="[0-9]{5}-?[0-9]{7}-?[0-9]" maxlength="15" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="date_of_birth">
                        Date of Birth <span class="urdu-label">(تاریخ پیدائش)</span> <span class="text-danger">*</span>
                    </label>
                    <input type="date" class="form-control membership-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" max="{{ now()->toDateString() }}" required>
                </div>

                {{-- Row 6: Education & Profession --}}
                <div class="col-md-6">
                    <label class="form-label" for="education">
                        Education <span class="urdu-label">(تعلیم)</span> <span class="text-danger">*</span>
                    </label>
                    <select class="form-select membership-control" id="education" name="education" required>
                        <option value="" {{ old('education') ? '' : 'selected' }}>Select</option>
                        <option value="Primary" {{ old('education') === 'Primary' ? 'selected' : '' }}>Primary / Middle</option>
                        <option value="Matriculation" {{ old('education') === 'Matriculation' ? 'selected' : '' }}>Matriculation (میٹرک)</option>
                        <option value="Intermediate" {{ old('education') === 'Intermediate' ? 'selected' : '' }}>Intermediate (انٹر)</option>
                        <option value="Bachelor" {{ old('education') === 'Bachelor' ? 'selected' : '' }}>Bachelor (گریجویشن)</option>
                        <option value="Master" {{ old('education') === 'Master' ? 'selected' : '' }}>Master (ماسٹرز)</option>
                        <option value="M.Phil" {{ old('education') === 'M.Phil' ? 'selected' : '' }}>M.Phil / MS</option>
                        <option value="PhD" {{ old('education') === 'PhD' ? 'selected' : '' }}>PhD / Doctorate</option>
                        <option value="Other" {{ old('education') === 'Other' ? 'selected' : '' }}>Other (دیگر)</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="profession">
                        Profession <span class="urdu-label">(پیشہ)</span> <span class="text-danger">*</span>
                    </label>
                    <select class="form-select membership-control" id="profession" name="profession" required>
                        <option value="" {{ old('profession') ? '' : 'selected' }}>Select</option>
                        <option value="Agriculture / Farmer" {{ old('profession') === 'Agriculture / Farmer' ? 'selected' : '' }}>Agriculture / Farmer (زراعت / کاشتکار)</option>
                        <option value="Business / Trader" {{ old('profession') === 'Business / Trader' ? 'selected' : '' }}>Business / Trader (کاروبار / تجارت)</option>
                        <option value="Government Employee" {{ old('profession') === 'Government Employee' ? 'selected' : '' }}>Government Employee (سرکاری ملازم)</option>
                        <option value="Private Employee" {{ old('profession') === 'Private Employee' ? 'selected' : '' }}>Private Employee (نجی ملازم)</option>
                        <option value="Lawyer / Advocate" {{ old('profession') === 'Lawyer / Advocate' ? 'selected' : '' }}>Lawyer / Advocate (وکیل)</option>
                        <option value="Doctor / Healthcare" {{ old('profession') === 'Doctor / Healthcare' ? 'selected' : '' }}>Doctor / Healthcare (ڈاکٹر / شعبہ صحت)</option>
                        <option value="Engineer" {{ old('profession') === 'Engineer' ? 'selected' : '' }}>Engineer (انجینئر)</option>
                        <option value="Teacher / Professor" {{ old('profession') === 'Teacher / Professor' ? 'selected' : '' }}>Teacher / Professor (استاد / شعبہ تعلیم)</option>
                        <option value="Student" {{ old('profession') === 'Student' ? 'selected' : '' }}>Student (طالب علم)</option>
                        <option value="Laborer / Worker" {{ old('profession') === 'Laborer / Worker' ? 'selected' : '' }}>Laborer / Worker (مزدور / محنت کش)</option>
                        <option value="Freelancer / IT" {{ old('profession') === 'Freelancer / IT' ? 'selected' : '' }}>Freelancer / IT (فری لانسر / آئی ٹی)</option>
                        <option value="Homemaker" {{ old('profession') === 'Homemaker' ? 'selected' : '' }}>Homemaker (گھریلو خاتون)</option>
                        <option value="Retired" {{ old('profession') === 'Retired' ? 'selected' : '' }}>Retired (ریٹائرڈ)</option>
                        <option value="Other" {{ old('profession') === 'Other' ? 'selected' : '' }}>Other (دیگر)</option>
                    </select>
                </div>

                {{-- Row 7: Resident Type & Province --}}
                <div class="col-md-6">
                    <label class="form-label" for="resident_type">
                        Resident Type <span class="urdu-label">(رہائشی کی قسم)</span> <span class="text-danger">*</span>
                    </label>
                    <select class="form-select membership-control" id="resident_type" name="resident_type" required>
                        <option value="Pakistani" {{ old('resident_type', 'Pakistani') === 'Pakistani' ? 'selected' : '' }}>Pakistani</option>
                        <option value="Overseas Pakistani" {{ old('resident_type') === 'Overseas Pakistani' ? 'selected' : '' }}>Overseas Pakistani</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="province">
                        Province <span class="urdu-label">(صوبہ)</span> <span class="text-danger">*</span>
                    </label>
                    <select class="form-select membership-control" id="province" name="province" required>
                        <option value="" {{ old('province') ? '' : 'selected' }}>Select</option>
                        <option value="Sindh" {{ old('province', 'Sindh') === 'Sindh' ? 'selected' : '' }}>Sindh (سندھ)</option>
                        <option value="Punjab" {{ old('province') === 'Punjab' ? 'selected' : '' }}>Punjab (پنجاب)</option>
                        <option value="Khyber Pakhtunkhwa" {{ old('province') === 'Khyber Pakhtunkhwa' ? 'selected' : '' }}>Khyber Pakhtunkhwa (خیبر پختونخوا)</option>
                        <option value="Balochistan" {{ old('province') === 'Balochistan' ? 'selected' : '' }}>Balochistan (بلوچستان)</option>
                        <option value="Islamabad Capital Territory" {{ old('province') === 'Islamabad Capital Territory' ? 'selected' : '' }}>Islamabad Capital Territory (اسلام آباد)</option>
                        <option value="Gilgit-Baltistan" {{ old('province') === 'Gilgit-Baltistan' ? 'selected' : '' }}>Gilgit-Baltistan (گلگت بلتستان)</option>
                        <option value="Azad Jammu and Kashmir" {{ old('province') === 'Azad Jammu and Kashmir' ? 'selected' : '' }}>Azad Jammu and Kashmir (آزاد کشمیر)</option>
                    </select>
                </div>

                {{-- Row 8: Division & District --}}
                <div class="col-md-6">
                    <label class="form-label" for="division">
                        Division <span class="urdu-label">(ڈویژن)</span> <span class="text-danger">*</span>
                    </label>
                    <select class="form-select membership-control" id="division" name="division" required>
                        <option value="" {{ old('division') ? '' : 'selected' }}>Select</option>
                        <option value="Hyderabad" {{ old('division', 'Hyderabad') === 'Hyderabad' ? 'selected' : '' }}>Hyderabad (حیدرآباد)</option>
                        <option value="Larkana" {{ old('division') === 'Larkana' ? 'selected' : '' }}>Larkana (لاڑکانہ)</option>
                        <option value="Sukkur" {{ old('division') === 'Sukkur' ? 'selected' : '' }}>Sukkur (سکھر)</option>
                        <option value="Karachi" {{ old('division') === 'Karachi' ? 'selected' : '' }}>Karachi (کراچی)</option>
                        <option value="Shaheed Benazirabad" {{ old('division') === 'Shaheed Benazirabad' ? 'selected' : '' }}>Shaheed Benazirabad (شہید بینظیر آباد)</option>
                        <option value="Mirpurkhas" {{ old('division') === 'Mirpurkhas' ? 'selected' : '' }}>Mirpurkhas (میرپورخاص)</option>
                        <option value="Other" {{ old('division') === 'Other' ? 'selected' : '' }}>Other (دیگر)</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="district">
                        District <span class="urdu-label">(ضلع)</span> <span class="text-danger">*</span>
                    </label>
                    <select class="form-select membership-control" id="district" name="district" required>
                        <option value="" {{ old('district') ? '' : 'selected' }}>Select</option>
                        <option value="Dadu" {{ old('district', 'Dadu') === 'Dadu' ? 'selected' : '' }}>Dadu (دادو)</option>
                        <option value="Jamshoro" {{ old('district') === 'Jamshoro' ? 'selected' : '' }}>Jamshoro (جامشورو)</option>
                        <option value="Hyderabad" {{ old('district') === 'Hyderabad' ? 'selected' : '' }}>Hyderabad (حیدرآباد)</option>
                        <option value="Matiari" {{ old('district') === 'Matiari' ? 'selected' : '' }}>Matiari (مٹیاری)</option>
                        <option value="Tando Allahyar" {{ old('district') === 'Tando Allahyar' ? 'selected' : '' }}>Tando Allahyar (ٹنڈو الہ یار)</option>
                        <option value="Tando Muhammad Khan" {{ old('district') === 'Tando Muhammad Khan' ? 'selected' : '' }}>Tando Muhammad Khan (ٹنڈو محمد خان)</option>
                        <option value="Badin" {{ old('district') === 'Badin' ? 'selected' : '' }}>Badin (بدین)</option>
                        <option value="Thatta" {{ old('district') === 'Thatta' ? 'selected' : '' }}>Thatta (ٹھٹہ)</option>
                        <option value="Sujawal" {{ old('district') === 'Sujawal' ? 'selected' : '' }}>Sujawal (سجاول)</option>
                        <option value="Larkana" {{ old('district') === 'Larkana' ? 'selected' : '' }}>Larkana (لاڑکانہ)</option>
                        <option value="Qambar Shahdadkot" {{ old('district') === 'Qambar Shahdadkot' ? 'selected' : '' }}>Qambar Shahdadkot (قنبر شہدادکوٹ)</option>
                        <option value="Shikarpur" {{ old('district') === 'Shikarpur' ? 'selected' : '' }}>Shikarpur (شکارپور)</option>
                        <option value="Jacobabad" {{ old('district') === 'Jacobabad' ? 'selected' : '' }}>Jacobabad (جیکب آباد)</option>
                        <option value="Kashmore" {{ old('district') === 'Kashmore' ? 'selected' : '' }}>Kashmore (کشمور)</option>
                        <option value="Sukkur" {{ old('district') === 'Sukkur' ? 'selected' : '' }}>Sukkur (سکھر)</option>
                        <option value="Ghotki" {{ old('district') === 'Ghotki' ? 'selected' : '' }}>Ghotki (گھوٹکی)</option>
                        <option value="Khairpur" {{ old('district') === 'Khairpur' ? 'selected' : '' }}>Khairpur (خیرپور)</option>
                        <option value="Shaheed Benazirabad" {{ old('district') === 'Shaheed Benazirabad' ? 'selected' : '' }}>Shaheed Benazirabad (شہید بینظیر آباد)</option>
                        <option value="Naushahro Feroze" {{ old('district') === 'Naushahro Feroze' ? 'selected' : '' }}>Naushahro Feroze (نوشہرو فیروز)</option>
                        <option value="Sanghar" {{ old('district') === 'Sanghar' ? 'selected' : '' }}>Sanghar (سانگھڑ)</option>
                        <option value="Mirpurkhas" {{ old('district') === 'Mirpurkhas' ? 'selected' : '' }}>Mirpurkhas (میرپورخاص)</option>
                        <option value="Umerkot" {{ old('district') === 'Umerkot' ? 'selected' : '' }}>Umerkot (عمرکوٹ)</option>
                        <option value="Tharparkar" {{ old('district') === 'Tharparkar' ? 'selected' : '' }}>Tharparkar (تھرپارکر)</option>
                        <option value="Karachi Central" {{ old('district') === 'Karachi Central' ? 'selected' : '' }}>Karachi Central (کراچی سینٹرل)</option>
                        <option value="Karachi East" {{ old('district') === 'Karachi East' ? 'selected' : '' }}>Karachi East (کراچی ایسٹ)</option>
                        <option value="Karachi South" {{ old('district') === 'Karachi South' ? 'selected' : '' }}>Karachi South (کراچی ساؤتھ)</option>
                        <option value="Karachi West" {{ old('district') === 'Karachi West' ? 'selected' : '' }}>Karachi West (کراچی ویسٹ)</option>
                        <option value="Korangi" {{ old('district') === 'Korangi' ? 'selected' : '' }}>Korangi (کورنگی)</option>
                        <option value="Malir" {{ old('district') === 'Malir' ? 'selected' : '' }}>Malir (ملیر)</option>
                        <option value="Keamari" {{ old('district') === 'Keamari' ? 'selected' : '' }}>Keamari (کیماڑی)</option>
                        <option value="Other" {{ old('district') === 'Other' ? 'selected' : '' }}>Other (دیگر)</option>
                    </select>
                </div>

                {{-- Row 9: Tehsil / City --}}
                <div class="col-md-6">
                    <label class="form-label" for="tehsil_city">
                        Tehsil / City <span class="urdu-label">(تحصیل / شہر)</span> <span class="text-danger">*</span>
                    </label>
                    <select class="form-select membership-control" id="tehsil_city" name="tehsil_city" required>
                        <option value="" {{ old('tehsil_city') ? '' : 'selected' }}>Select</option>
                        <option value="Dadu" {{ old('tehsil_city', 'Dadu') === 'Dadu' ? 'selected' : '' }}>Dadu (دادو)</option>
                        <option value="Mehar" {{ old('tehsil_city') === 'Mehar' ? 'selected' : '' }}>Mehar (میہڑ)</option>
                        <option value="Khairpur Nathan Shah" {{ old('tehsil_city') === 'Khairpur Nathan Shah' ? 'selected' : '' }}>Khairpur Nathan Shah (خیرپور ناتھن شاہ)</option>
                        <option value="Johi" {{ old('tehsil_city') === 'Johi' ? 'selected' : '' }}>Johi (جوہی)</option>
                        <option value="Other" {{ old('tehsil_city') === 'Other' ? 'selected' : '' }}>Other (دیگر)</option>
                    </select>
                </div>
                <div class="col-md-6 d-none d-md-block">
                    {{-- Empty column to maintain balance --}}
                </div>

                {{-- Row 10: Current Address --}}
                <div class="col-12">
                    <label class="form-label" for="current_address">
                        Current Address <span class="urdu-label">(موجودہ پتہ)</span> <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control membership-control" id="current_address" name="current_address" rows="2" placeholder="Enter Address" maxlength="1000" required>{{ old('current_address') }}</textarea>
                </div>

                {{-- Row 11: Permanent Address --}}
                <div class="col-12">
                    <label class="form-label" for="permanent_address">
                        Permanent Address <span class="urdu-label">(مستقل پتہ)</span> <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control membership-control" id="permanent_address" name="permanent_address" rows="2" placeholder="Enter Address" maxlength="1000" required>{{ old('permanent_address') }}</textarea>
                </div>

                {{-- Row 12: Facebook & Twitter URLs --}}
                <div class="col-md-6">
                    <label class="form-label" for="facebook_url">
                        Facebook Profile URL <span class="urdu-label">(فیس بک پروفائل یو آر ایل)</span>
                    </label>
                    <input type="url" class="form-control membership-control" id="facebook_url" name="facebook_url" value="{{ old('facebook_url') }}" placeholder="Enter Url" maxlength="255">
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="twitter_url">
                        Twitter Profile URL <span class="urdu-label">(ٹوئٹر پروفائل یو آر ایل)</span>
                    </label>
                    <input type="url" class="form-control membership-control" id="twitter_url" name="twitter_url" value="{{ old('twitter_url') }}" placeholder="Enter Url" maxlength="255">
                </div>

                {{-- Row 13: Instagram & Tiktok URLs --}}
                <div class="col-md-6">
                    <label class="form-label" for="instagram_url">
                        Instagram Profile URL <span class="urdu-label">(انسٹاگرام پروفائل یو آر ایل)</span>
                    </label>
                    <input type="url" class="form-control membership-control" id="instagram_url" name="instagram_url" value="{{ old('instagram_url') }}" placeholder="Enter Url" maxlength="255">
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="tiktok_url">
                        Tiktok Profile URL <span class="urdu-label">(ٹک ٹاک پروفائل یو آر ایل)</span>
                    </label>
                    <input type="url" class="form-control membership-control" id="tiktok_url" name="tiktok_url" value="{{ old('tiktok_url') }}" placeholder="Enter Url" maxlength="255">
                </div>

                {{-- Row 14: Volunteering Preferences --}}
                <div class="col-12 mt-3">
                    <label class="form-label fw-bold mb-2">
                        Volunteering Preferences <span class="urdu-label">(رضاکارانہ ترجیحات)</span>
                    </label>
                    <div class="row g-2">
                        {{-- Column 1 --}}
                        <div class="col-md-4">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="volunteering[]" value="Polling Agent" id="vol_polling_agent" {{ is_array(old('volunteering')) && in_array('Polling Agent', old('volunteering')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="vol_polling_agent">Polling Agent</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="volunteering[]" value="Phone Campaign" id="vol_phone_campaign" {{ is_array(old('volunteering')) && in_array('Phone Campaign', old('volunteering')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="vol_phone_campaign">Phone Campaign</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="volunteering[]" value="Mentoring Program" id="vol_mentoring_program" {{ is_array(old('volunteering')) && in_array('Mentoring Program', old('volunteering')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="vol_mentoring_program">Mentoring Program</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="volunteering[]" value="Legal Aid" id="vol_legal_aid" {{ is_array(old('volunteering')) && in_array('Legal Aid', old('volunteering')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="vol_legal_aid">Legal Aid</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="volunteering[]" value="Other" id="vol_other" {{ is_array(old('volunteering')) && in_array('Other', old('volunteering')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="vol_other">Other</label>
                            </div>
                        </div>

                        {{-- Column 2 --}}
                        <div class="col-md-4">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="volunteering[]" value="Social Causes" id="vol_social_causes" {{ is_array(old('volunteering')) && in_array('Social Causes', old('volunteering')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="vol_social_causes">Social Causes</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="volunteering[]" value="Election Day" id="vol_election_day" {{ is_array(old('volunteering')) && in_array('Election Day', old('volunteering')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="vol_election_day">Election Day</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="volunteering[]" value="Environmental Sustainability" id="vol_environmental" {{ is_array(old('volunteering')) && in_array('Environmental Sustainability', old('volunteering')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="vol_environmental">Environmental Sustainability</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="volunteering[]" value="Event Organization" id="vol_event_organization" {{ is_array(old('volunteering')) && in_array('Event Organization', old('volunteering')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="vol_event_organization">Event Organization</label>
                            </div>
                        </div>

                        {{-- Column 3 --}}
                        <div class="col-md-4">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="volunteering[]" value="Door-to-Door Canvassing" id="vol_door_to_door" {{ is_array(old('volunteering')) && in_array('Door-to-Door Canvassing', old('volunteering')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="vol_door_to_door">Door-to-Door Canvassing</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="volunteering[]" value="Member Drive" id="vol_member_drive" {{ is_array(old('volunteering')) && in_array('Member Drive', old('volunteering')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="vol_member_drive">Member Drive</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="volunteering[]" value="Social Media" id="vol_social_media" {{ is_array(old('volunteering')) && in_array('Social Media', old('volunteering')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="vol_social_media">Social Media</label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="volunteering[]" value="Medical Aid" id="vol_medical_aid" {{ is_array(old('volunteering')) && in_array('Medical Aid', old('volunteering')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="vol_medical_aid">Medical Aid</label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Row 15: reCAPTCHA Widget --}}
                <div class="col-12 my-2">
                    <div class="membership-recaptcha-wrap">
                        <div class="recaptcha-widget-card" id="recaptchaCard">
                            <label class="recaptcha-checkbox-label">
                                <input type="checkbox" name="recaptcha_verified" value="1" id="recaptchaCheckbox" required>
                                <span class="recaptcha-checkbox-custom" id="recaptchaCheckCustom">
                                    <i class="fa-solid fa-check" aria-hidden="true"></i>
                                </span>
                                <span class="recaptcha-text">I'm not a robot</span>
                            </label>
                            <div class="recaptcha-brand">
                                <img src="https://www.gstatic.com/recaptcha/api2/logo_48.png" alt="reCAPTCHA" class="recaptcha-logo" width="32" height="32">
                                <div class="recaptcha-brand-text">
                                    <span class="recaptcha-brand-title">reCAPTCHA</span>
                                    <div class="recaptcha-brand-links">
                                        <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">Privacy</a> - 
                                        <a href="https://policies.google.com/terms" target="_blank" rel="noopener">Terms</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Row 16: Submit Button --}}
                <div class="col-12">
                    <button type="submit" class="btn membership-submit-btn" id="membershipSubmitBtn">
                        Submit
                    </button>
                </div>

                {{-- Row 17: Footnote --}}
                <div class="col-12">
                    <p class="membership-help-note">
                        If case of any complains/suggestions please get in touch with us by <a href="{{ route('pages.contact') }}">clicking here</a>
                    </p>
                </div>
            </div>
        </form>
    </section>
</div>

{{-- Community Impact Banner (Matches Contact, District Body, Leadership pages) --}}
<section class="membership-impact" aria-label="Community impact">
    <div class="membership-impact-message">
        <span><i class="fa-solid fa-people-group" aria-hidden="true"></i></span>
        <div>
            <h2>Working for Stronger Communities</h2>
            <p>Our municipal and town bodies are playing a vital role in building a better, cleaner and developed District Dadu. Together we can create a brighter future for our people.</p>
        </div>
    </div>
    <ul>
        <li><i class="fa-solid fa-landmark" aria-hidden="true"></i><span>Better Governance</span></li>
        <li><i class="fa-solid fa-chart-line" aria-hidden="true"></i><span>Local Development</span></li>
        <li><i class="fa-solid fa-users" aria-hidden="true"></i><span>Community Support</span></li>
        <li><i class="fa-solid fa-scale-balanced" aria-hidden="true"></i><span>Public Welfare</span></li>
    </ul>
</section>
