(function ($) {
    'use strict';

    $(function () {
        $('[data-current-year]').text(new Date().getFullYear());

        $('#mainNavigation').on('click', 'a:not(.dropdown-toggle)', function () {
            const navigation = document.getElementById('mainNavigation');

            if (navigation.classList.contains('show')) {
                bootstrap.Collapse.getOrCreateInstance(navigation).hide();
            }
        });

        $('#galleryModal').on('show.bs.modal', function (event) {
            const image = $(event.relatedTarget);
            const modalImage = this.querySelector('.gallery-modal-image');

            modalImage.src = image.data('gallery-image');
            modalImage.alt = image.data('gallery-alt');
        });

        $('.media-gallery-filters').on('click', '[data-gallery-filter]', function () {
            const filter = $(this).data('gallery-filter');

            $('.media-gallery-filters [data-gallery-filter]')
                .removeClass('active')
                .attr('aria-pressed', 'false');
            $(this).addClass('active').attr('aria-pressed', 'true');

            $('.media-gallery-card').each(function () {
                const matches = filter === 'all' || $(this).data('gallery-category') === filter;

                $(this).toggle(matches);
            });
        });

        $('[data-membership-wizard]').each(function () {
            const form = this;
            const steps = Array.from(form.querySelectorAll('[data-membership-step]'));
            const indicators = Array.from(form.querySelectorAll('[data-membership-step-indicator]'));
            const previousButton = form.querySelector('[data-membership-previous]');
            const nextButton = form.querySelector('[data-membership-next]');
            const submitButton = form.querySelector('[data-membership-submit]');
            let currentStep = 0;

            const showStep = (step) => {
                currentStep = step;

                steps.forEach((fieldset, index) => {
                    fieldset.hidden = index !== currentStep;
                    indicators[index].classList.toggle('active', index === currentStep);
                    indicators[index].classList.toggle('complete', index < currentStep);
                });

                previousButton.hidden = currentStep === 0;
                nextButton.hidden = currentStep === steps.length - 1;
                submitButton.hidden = currentStep !== steps.length - 1;
            };

            nextButton.addEventListener('click', () => {
                const fields = Array.from(steps[currentStep].querySelectorAll('input, select, textarea'));
                const invalidField = fields.find((field) => !field.checkValidity());

                if (invalidField) {
                    invalidField.reportValidity();
                    return;
                }

                showStep(currentStep + 1);
            });

            previousButton.addEventListener('click', () => showStep(currentStep - 1));

            form.addEventListener('submit', (event) => {
                const fields = Array.from(steps[currentStep].querySelectorAll('input, select, textarea'));
                const invalidField = fields.find((field) => !field.checkValidity());

                if (invalidField) {
                    event.preventDefault();
                    invalidField.reportValidity();
                }
            });

            showStep(0);
        });

        // Membership Portal Interactive Enhancements
        const membershipPortalForm = document.getElementById('membershipPortalForm');
        if (membershipPortalForm) {
            // 1. CNIC Auto-Formatting (XXXXX-XXXXXXX-X)
            const cnicInput = document.getElementById('cnic_number');
            if (cnicInput) {
                cnicInput.addEventListener('input', function (e) {
                    let val = this.value.replace(/\D/g, '').substring(0, 13);
                    if (val.length > 5 && val.length <= 12) {
                        val = val.substring(0, 5) + '-' + val.substring(5);
                    } else if (val.length > 12) {
                        val = val.substring(0, 5) + '-' + val.substring(5, 12) + '-' + val.substring(12, 13);
                    }
                    this.value = val;
                });
            }

            // 2. Mobile number default & auto-formatting
            const mobileInput = document.getElementById('mobile_number');
            if (mobileInput) {
                mobileInput.addEventListener('focus', function () {
                    if (!this.value.trim()) {
                        this.value = '03';
                    }
                });
                mobileInput.addEventListener('input', function () {
                    let val = this.value.replace(/\D/g, '').substring(0, 11);
                    this.value = val;
                });
            }

            // 3. Simulated reCAPTCHA smooth feedback
            const recaptchaCard = document.getElementById('recaptchaCard');
            const recaptchaCheckbox = document.getElementById('recaptchaCheckbox');
            const recaptchaCheckCustom = document.getElementById('recaptchaCheckCustom');
            if (recaptchaCheckbox && recaptchaCheckCustom) {
                recaptchaCheckbox.addEventListener('change', function () {
                    if (this.checked) {
                        recaptchaCheckCustom.innerHTML = '<i class="fa-solid fa-spinner fa-spin" style="font-size: 13px; color: #0b603d;"></i>';
                        recaptchaCheckCustom.style.borderColor = '#0b603d';
                        setTimeout(() => {
                            recaptchaCheckCustom.innerHTML = '<i class="fa-solid fa-check" style="font-size: 14px; color: #ffffff;"></i>';
                        }, 400);
                    } else {
                        recaptchaCheckCustom.innerHTML = '';
                    }
                });
            }

            // 4. Hierarchical Location Cascading
            const locationData = {
                'Sindh': {
                    'Hyderabad': {
                        'Dadu': ['Dadu', 'Mehar', 'Khairpur Nathan Shah', 'Johi'],
                        'Jamshoro': ['Kotri', 'Sehwan', 'Manjhand', 'Thano Bula Khan'],
                        'Hyderabad': ['Hyderabad City', 'Latifabad', 'Qasimabad', 'Hyderabad Rural'],
                        'Matiari': ['Matiari', 'Hala', 'Saeedabad'],
                        'Tando Allahyar': ['Tando Allahyar', 'Chamber', 'Jhando Mari'],
                        'Tando Muhammad Khan': ['Tando Muhammad Khan', 'Bulri Shah Karim', 'Tando Ghulam Hyder'],
                        'Badin': ['Badin', 'Matli', 'Talhar', 'Tando Bago', 'Golarchi'],
                        'Thatta': ['Thatta', 'Mirpur Sakro', 'Ghorabari', 'Keti Bandar'],
                        'Sujawal': ['Sujawal', 'Jati', 'Shah Bunder', 'Kharo Chan', 'Mirpur Bathoro']
                    },
                    'Larkana': {
                        'Larkana': ['Larkana', 'Ratodero', 'Bakrani', 'Dokri'],
                        'Qambar Shahdadkot': ['Qambar', 'Shahdadkot', 'Warah', 'Mirokhan', 'Nasirabad', 'Qubo Saeed Khan'],
                        'Shikarpur': ['Shikarpur', 'Lakhi Ghulam Shah', 'Garhi Yasin', 'Khanpur'],
                        'Jacobabad': ['Jacobabad', 'Garhi Khairo', 'Thul'],
                        'Kashmore': ['Kashmore', 'Kandhkot', 'Tangwani']
                    },
                    'Sukkur': {
                        'Sukkur': ['Sukkur City', 'New Sukkur', 'Rohri', 'Pano Aqil', 'Salehpat'],
                        'Ghotki': ['Ghotki', 'Mirpur Mathelo', 'Ubauro', 'Daharki', 'Khangarh'],
                        'Khairpur': ['Khairpur', 'Kot Diji', 'Sobhodero', 'Kingri', 'Gambat', 'Nara']
                    },
                    'Shaheed Benazirabad': {
                        'Shaheed Benazirabad': ['Nawabshah', 'Daur', 'Sakrand', 'Kazi Ahmed'],
                        'Naushahro Feroze': ['Naushahro Feroze', 'Moro', 'Bhiria', 'Kandiaro', 'Mehrabpur'],
                        'Sanghar': ['Sanghar', 'Shahdadpur', 'Sinjhoro', 'Tando Adam', 'Jam Nawaz Ali', 'Khipro']
                    },
                    'Mirpurkhas': {
                        'Mirpurkhas': ['Mirpurkhas', 'Shujabad', 'Kot Ghulam Muhammad', 'Sindhri'],
                        'Umerkot': ['Umerkot', 'Kunri', 'Samaro', 'Pithoro'],
                        'Tharparkar': ['Mithi', 'Islamkot', 'Nagarparkar', 'Diplo', 'Chachro', 'Dahli']
                    },
                    'Karachi': {
                        'Karachi Central': ['Gulberg', 'Liaquatabad', 'North Nazimabad', 'New Karachi'],
                        'Karachi East': ['Gulshan-e-Iqbal', 'Jamshed Town', 'Ferozabad'],
                        'Karachi South': ['Saddar', 'Arambagh', 'Civil Lines', 'Garden'],
                        'Karachi West': ['Orangi', 'Mominabad', 'Manghopir'],
                        'Korangi': ['Korangi', 'Landhi', 'Shah Faisal', 'Model Colony'],
                        'Malir': ['Malir', 'Bin Qasim', 'Gadap', 'Ibrahim Hyderi'],
                        'Keamari': ['Keamari', 'Baldia', 'Site', 'Mauripur']
                    }
                }
            };

            const provinceSelect = document.getElementById('province');
            const divisionSelect = document.getElementById('division');
            const districtSelect = document.getElementById('district');
            const tehsilSelect = document.getElementById('tehsil_city');

            if (provinceSelect && divisionSelect && districtSelect && tehsilSelect) {
                function updateDivisions() {
                    const prov = provinceSelect.value;
                    const prevDiv = divisionSelect.value;
                    if (locationData[prov]) {
                        divisionSelect.innerHTML = '<option value="">Select</option>';
                        Object.keys(locationData[prov]).forEach(div => {
                            const opt = document.createElement('option');
                            opt.value = div;
                            opt.textContent = div;
                            if (div === prevDiv || (!prevDiv && div === 'Hyderabad')) {
                                opt.selected = true;
                            }
                            divisionSelect.appendChild(opt);
                        });
                        const otherOpt = document.createElement('option');
                        otherOpt.value = 'Other';
                        otherOpt.textContent = 'Other';
                        divisionSelect.appendChild(otherOpt);
                        updateDistricts();
                    }
                }

                function updateDistricts() {
                    const prov = provinceSelect.value;
                    const div = divisionSelect.value;
                    const prevDist = districtSelect.value;
                    if (locationData[prov] && locationData[prov][div]) {
                        districtSelect.innerHTML = '<option value="">Select</option>';
                        Object.keys(locationData[prov][div]).forEach(dist => {
                            const opt = document.createElement('option');
                            opt.value = dist;
                            opt.textContent = dist;
                            if (dist === prevDist || (!prevDist && dist === 'Dadu')) {
                                opt.selected = true;
                            }
                            districtSelect.appendChild(opt);
                        });
                        const otherOpt = document.createElement('option');
                        otherOpt.value = 'Other';
                        otherOpt.textContent = 'Other';
                        districtSelect.appendChild(otherOpt);
                        updateTehsils();
                    }
                }

                function updateTehsils() {
                    const prov = provinceSelect.value;
                    const div = divisionSelect.value;
                    const dist = districtSelect.value;
                    const prevTehsil = tehsilSelect.value;
                    if (locationData[prov] && locationData[prov][div] && locationData[prov][div][dist]) {
                        tehsilSelect.innerHTML = '<option value="">Select</option>';
                        locationData[prov][div][dist].forEach(tehsil => {
                            const opt = document.createElement('option');
                            opt.value = tehsil;
                            opt.textContent = tehsil;
                            if (tehsil === prevTehsil || (!prevTehsil && tehsil === 'Dadu')) {
                                opt.selected = true;
                            }
                            tehsilSelect.appendChild(opt);
                        });
                        const otherOpt = document.createElement('option');
                        otherOpt.value = 'Other';
                        otherOpt.textContent = 'Other';
                        tehsilSelect.appendChild(otherOpt);
                    }
                }

                provinceSelect.addEventListener('change', updateDivisions);
                divisionSelect.addEventListener('change', updateDistricts);
                districtSelect.addEventListener('change', updateTehsils);
            }
        }
    });
})(window.jQuery);
