<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>استكمال بيانات المكتب</title>


    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>


<style>

/* ============================
   Global
============================ */

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{

    font-family:'Cairo',sans-serif;

    background:#f4f7fb;

    direction:rtl;

    color:#1e293b;

}

.profile-page{

    min-height:100vh;

    padding:50px 20px;

}

.profile-container{

    width:100%;

    max-width:1300px;

    margin:auto;

}

/* ============================
   Header
============================ */

.profile-header{

    background:#ffffff;

    border-radius:18px;

    padding:30px;

    margin-bottom:25px;

    box-shadow:0 10px 25px rgba(0,0,0,.06);

    text-align:center;

}

.profile-header h1{

    font-size:34px;

    color:#0f4c81;

    margin-bottom:10px;

    font-weight:700;

}

.profile-header p{

    color:#64748b;

    font-size:17px;

    line-height:1.8;

}

/* ============================
   Cards
============================ */

.card{

    background:#fff;

    border-radius:18px;

    padding:30px;

    margin-bottom:25px;

    box-shadow:0 8px 25px rgba(0,0,0,.05);

    border:1px solid #edf2f7;

}

.card-title{

    display:flex;

    align-items:center;

    gap:12px;

    margin-bottom:25px;

    font-size:22px;

    font-weight:700;

    color:#0f4c81;

}

.card-title i{

    width:48px;

    height:48px;

    border-radius:12px;

    display:flex;

    align-items:center;

    justify-content:center;

    background:#0f4c81;

    color:#fff;

    font-size:20px;

}
/* ============================
   Form Grid
============================ */

.form-grid{

    display:grid;

    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));

    gap:22px;

}

.full-width{

    margin-top:20px;

}

/* ============================
   Form Group
============================ */

.form-group{

    display:flex;

    flex-direction:column;

}

.form-group label{

    font-size:15px;

    font-weight:700;

    margin-bottom:10px;

    color:#334155;

}

.form-group input,
.form-group textarea,
.form-group select{

    width:100%;

    border:1px solid #dbe4ee;

    border-radius:12px;

    background:#fff;

    padding:14px 16px;

    font-size:15px;

    transition:.3s;

    outline:none;

}

.form-group textarea{

    resize:vertical;

    min-height:140px;

}

.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus{

    border-color:#0f4c81;

    box-shadow:0 0 0 4px rgba(15,76,129,.12);

}

/* Placeholder */

.form-group input::placeholder,
.form-group textarea::placeholder{

    color:#94a3b8;

}

/* ============================
   Specialties
============================ */

.specialties-grid{

    display:grid;

    grid-template-columns:repeat(auto-fill,minmax(220px,1fr));

    gap:15px;

    margin-top:15px;

}

.specialties-grid label{

    display:flex;

    align-items:center;

    gap:10px;

    background:#f8fafc;

    border:1px solid #e2e8f0;

    border-radius:12px;

    padding:14px;

    cursor:pointer;

    transition:.3s;

    font-size:15px;

    font-weight:600;

}

.specialties-grid label:hover{

    border-color:#0f4c81;

    background:#eef6fd;

}

.specialties-grid input{

    width:18px;

    height:18px;

}


/* ============================
   Documents
============================ */

.documents-grid{

    display:grid;

    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));

    gap:20px;

    margin-top:20px;

}

.document-card{

    border:2px dashed #d8e3ef;

    border-radius:16px;

    padding:25px;

    text-align:center;

    transition:.3s;

    background:#fbfdff;

}

.document-card:hover{

    border-color:#0f4c81;

    background:#f3f9ff;

}

.document-card h4{

    margin-bottom:18px;

    color:#0f4c81;

    font-size:18px;

}

.document-card input[type=file]{

    width:100%;

    cursor:pointer;

}

.upload-status{

    margin-top:15px;

    font-size:14px;

    color:#64748b;

}


/* ============================
   Buttons
============================ */

.submit-box{

    display:flex;

    justify-content:center;

    gap:20px;

    margin-top:35px;

    flex-wrap:wrap;

}

.btn-primary,
.btn-success{

    border:none;

    padding:15px 35px;

    border-radius:12px;

    font-size:16px;

    font-weight:700;

    cursor:pointer;

    transition:.3s;

}

.btn-primary{

    background:#0f4c81;

    color:#fff;

}

.btn-primary:hover{

    background:#0b3b64;

}

.btn-success{

    background:#0c9b57;

    color:#fff;

}

.btn-success:hover{

    background:#097c46;

}

.btn-primary i,
.btn-success i{

    margin-left:8px;

}

/* ============================
   Responsive
============================ */

@media (max-width:992px){

    .profile-header{

        padding:25px;

    }

    .profile-header h1{

        font-size:28px;

    }

    .card{

        padding:22px;

    }

}

@media (max-width:768px){

    .profile-page{

        padding:20px 10px;

    }

    .profile-header{

        padding:20px;

    }

    .profile-header h1{

        font-size:24px;

    }

    .card{

        padding:18px;

    }

    .card-title{

        font-size:19px;

    }

    .card-title i{

        width:42px;

        height:42px;

        font-size:18px;

    }

    .form-grid{

        grid-template-columns:1fr;

    }

    .documents-grid{

        grid-template-columns:1fr;

    }

    .specialties-grid{

        grid-template-columns:1fr;

    }

    .submit-box{

        flex-direction:column;

    }

    .btn-primary,
    .btn-success{

        width:100%;

    }

}

@media (max-width:480px){

    .profile-header h1{

        font-size:21px;

    }

    .profile-header p{

        font-size:14px;

    }

    .form-group label{

        font-size:14px;

    }

    .form-group input,
    .form-group textarea{

        font-size:14px;

        padding:12px;

    }

}

</style>


</head>
<body>

<div class="profile-page">

    <div class="profile-container">

        <!-- ============================= -->
        <!-- HEADER -->
        <!-- ============================= -->

        <div class="profile-header">

            <h1>
                استكمال بيانات المكتب
            </h1>

            <p>
                يرجى استكمال جميع البيانات المطلوبة حتى يتم اعتماد حسابك.
            </p>

        </div>


        <!-- ============================= -->
        <!-- SUCCESS / ERROR MESSAGES -->
        <!-- ============================= -->

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        @endif


        <!-- ============================= -->
        <!-- PROFILE FORM -->
        <!-- ============================= -->

        <form
            id="officeProfileForm"
            action="{{ route('amrtm.office.complete-profile.save') }}"
            method="POST">

            @csrf


            <!-- ============================= -->
            <!-- بيانات المكتب -->
            <!-- ============================= -->

            <div class="card">

                <div class="card-title">

                    <i class="fa-solid fa-building"></i>

                    <span>
                        البيانات الأساسية
                    </span>

                </div>


                <div class="form-grid">


                    <!-- رقم الترخيص -->

                    <div class="form-group">

                        <label>
                            رقم الترخيص
                        </label>

                        <input
                            type="text"
                            id="license_number"
                            name="license_number"
                            value="{{ old('license_number', $profile->license_number ?? '') }}">

                    </div>


                    <!-- السجل التجاري -->

                    <div class="form-group">

                        <label>
                            رقم السجل التجاري
                        </label>

                        <input
                            type="text"
                            id="cr_number"
                            name="cr_number"
                            value="{{ old('cr_number', $profile->cr_number ?? $office->cr_number ?? '') }}">

                    </div>


                    <!-- الجوال -->

                    <div class="form-group">

                        <label>
                            رقم الجوال
                        </label>

                        <input
                            type="text"
                            id="mobile"
                            name="mobile"
                            value="{{ old('mobile', $profile->mobile ?? $office->phone ?? '') }}">

                    </div>


                    <!-- الدولة -->

                    <div class="form-group">

                        <label>
                            الدولة
                        </label>

                        <input
                            type="text"
                            id="country"
                            name="country"
                            value="{{ old('country', $profile->country ?? '') }}">

                    </div>


                    <!-- المنطقة -->

                    <div class="form-group">

                        <label>
                            المنطقة
                        </label>

                        <input
                            type="text"
                            id="governorate"
                            name="governorate"
                            value="{{ old('governorate', $profile->governorate ?? '') }}">

                    </div>


                    <!-- المدينة -->

                    <div class="form-group">

                        <label>
                            المدينة
                        </label>

                        <input
                            type="text"
                            id="city"
                            name="city"
                            value="{{ old('city', $profile->city ?? $office->city ?? '') }}">

                    </div>


                    <!-- الحي -->

                    <div class="form-group">

                        <label>
                            الحي
                        </label>

                        <input
                            type="text"
                            id="district"
                            name="district"
                            value="{{ old('district', $profile->district ?? '') }}">

                    </div>


                    <!-- الشارع -->

                    <div class="form-group">

                        <label>
                            الشارع
                        </label>

                        <input
                            type="text"
                            id="street"
                            name="street"
                            value="{{ old('street', $profile->street ?? '') }}">

                    </div>


                    <!-- رقم المبنى -->

                    <div class="form-group">

                        <label>
                            رقم المبنى
                        </label>

                        <input
                            type="text"
                            id="building_number"
                            name="building_number"
                            value="{{ old('building_number', $profile->building_number ?? '') }}">

                    </div>


                    <!-- رقم المكتب -->

                    <div class="form-group">

                        <label>
                            رقم المكتب
                        </label>

                        <input
                            type="text"
                            id="office_number"
                            name="office_number"
                            value="{{ old('office_number', $profile->office_number ?? '') }}">

                    </div>

                </div>

            </div>


            <!-- ============================= -->
            <!-- نبذة المكتب -->
            <!-- ============================= -->

            <div class="card">

                <div class="card-title">

                    <i class="fa-solid fa-file-lines"></i>

                    <span>
                        نبذة عن المكتب
                    </span>

                </div>


                <div class="form-group full-width">

                    <label>
                        الوصف بالعربية
                    </label>

                    <textarea
                        id="description_ar"
                        name="description_ar"
                        rows="5"
                        placeholder="اكتب نبذة مختصرة عن المكتب...">{{ old('description_ar', $profile->description_ar ?? $office->description_ar ?? '') }}</textarea>

                </div>


                <div class="form-group full-width">

                    <label>
                        الوصف بالإنجليزية (اختياري)
                    </label>

                    <textarea
                        id="description_en"
                        name="description_en"
                        rows="5"
                        placeholder="Office Description...">{{ old('description_en', $profile->description_en ?? $office->description_en ?? '') }}</textarea>

                </div>

            </div>


            <!-- ============================= -->
            <!-- التخصصات -->
            <!-- ============================= -->

            <div class="card">

                <div class="card-title">

                    <i class="fa-solid fa-list-check"></i>

                    <span>
                        التخصصات
                    </span>

                </div>


                <div
                    id="specialtiesContainer"
                    class="specialties-grid">

                    @php
                        $selectedSpecialties = old(
                            'specialties',
                            $office->specialtiesRelation
                                ? $office->specialtiesRelation->pluck('id')->toArray()
                                : []
                        );
                    @endphp


                    @if(isset($specialties) && $specialties->count())

                        @foreach($specialties as $specialty)

                            <label class="specialty-item">

                                <input
                                    type="checkbox"
                                    name="specialties[]"
                                    value="{{ $specialty->id }}"
                                    {{ in_array($specialty->id, $selectedSpecialties) ? 'checked' : '' }}>

                                <span>
                                    {{ $specialty->name_ar }}
                                </span>

                            </label>

                        @endforeach

                    @else

                        <div class="specialties-empty">
                            لا توجد تخصصات متاحة حاليًا.
                        </div>

                    @endif

                </div>


                <!-- تخصص آخر -->

                <div class="form-group full-width">

                    <label>
                        تخصص آخر
                    </label>

                    <input
                        type="text"
                        id="custom_specialty"
                        name="custom_specialty"
                        value="{{ old('custom_specialty', $profile->custom_specialty ?? '') }}"
                        placeholder="إذا لم تجد تخصصك اكتبه هنا">

                </div>

            </div>


            <!-- ============================= -->
            <!-- الخبرة -->
            <!-- ============================= -->

            <div class="card">

                <div class="card-title">

                    <i class="fa-solid fa-briefcase"></i>

                    <span>
                        الخبرة
                    </span>

                </div>


                <div class="form-grid">

                    <div class="form-group">

                        <label>
                            عدد القضايا / المشاريع المنجزة
                        </label>

                        <input
                            type="number"
                            id="handled_cases"
                            name="handled_cases"
                            min="0"
                            value="{{ old('handled_cases', $profile->handled_cases ?? 0) }}">

                    </div>

                </div>

            </div>


            <!-- ============================= -->
            <!-- رفع المستندات -->
            <!-- ============================= -->

            <div class="card">

                <div class="card-title">

                    <i class="fa-solid fa-folder-open"></i>

                    <span>
                        رفع المستندات
                    </span>

                </div>


                <div class="documents-grid">


                    <!-- الترخيص -->

                    <div class="document-card">

                        <h4>
                            الترخيص
                        </h4>

                        <input
                            type="file"
                            id="license_file"
                            data-type="license">

                        <div
                            class="upload-status"
                            id="status-license">

                            لم يتم رفع الملف

                        </div>

                    </div>


                    <!-- السجل التجاري -->

                    <div class="document-card">

                        <h4>
                            السجل التجاري
                        </h4>

                        <input
                            type="file"
                            id="commercial_file"
                            data-type="commercial_register">

                        <div
                            class="upload-status"
                            id="status-commercial_register">

                            لم يتم رفع الملف

                        </div>

                    </div>


                    <!-- السيرة الذاتية -->

                    <div class="document-card">

                        <h4>
                            السيرة الذاتية
                        </h4>

                        <input
                            type="file"
                            id="cv_file"
                            data-type="cv">

                        <div
                            class="upload-status"
                            id="status-cv">

                            لم يتم رفع الملف

                        </div>

                    </div>


                    <!-- الشهادات -->

                    <div class="document-card">

                        <h4>
                            الشهادات
                        </h4>

                        <input
                            type="file"
                            id="certificate_file"
                            data-type="certificate">

                        <div
                            class="upload-status"
                            id="status-certificate">

                            لم يتم رفع الملف

                        </div>

                    </div>


                    <!-- الجوائز -->

                    <div class="document-card">

                        <h4>
                            الجوائز
                        </h4>

                        <input
                            type="file"
                            id="award_file"
                            data-type="award">

                        <div
                            class="upload-status"
                            id="status-award">

                            لم يتم رفع الملف

                        </div>

                    </div>


                    <!-- الخبرات -->

                    <div class="document-card">

                        <h4>
                            الخبرات
                        </h4>

                        <input
                            type="file"
                            id="experience_file"
                            data-type="experience">

                        <div
                            class="upload-status"
                            id="status-experience">

                            لم يتم رفع الملف

                        </div>

                    </div>

                </div>

            </div>


            <!-- ============================= -->
            <!-- حفظ البيانات -->
            <!-- ============================= -->

            <div class="submit-box">

                <button
                    type="submit"
                    id="saveProfileBtn"
                    class="btn-primary">

                    <i class="fa-solid fa-floppy-disk"></i>

                    حفظ البيانات

                </button>

            </div>


        </form>


        <!-- ============================= -->
        <!-- إرسال للمراجعة -->
        <!-- ============================= -->

        <form
            action="{{ route('amrtm.office.complete-profile.submit') }}"
            method="POST">

            @csrf

            <div class="submit-box">

                <button
                    type="submit"
                    id="submitReviewBtn"
                    class="btn-success">

                    <i class="fa-solid fa-paper-plane"></i>

                    إرسال للمراجعة

                </button>

            </div>

        </form>


    </div>

</div>


<!-- ============================= -->
<!-- JavaScript -->
<!-- ============================= -->

<script>

document.addEventListener("DOMContentLoaded", function () {

    console.log("Office Profile Loaded");

});

</script>

</body>

</body>

</html>