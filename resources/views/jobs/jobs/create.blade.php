@extends('jobs.layouts.app')

@section('title', 'إنشاء وظيفة جديدة')

@section('content')
<div class="min-h-screen bg-surface-50 py-12">
  <div class="max-w-4xl mx-auto px-6">
    <!-- Header -->
    <div class="mb-8">
      <h1 class="text-4xl font-bold text-surface-900">إنشاء وظيفة جديدة</h1>
      <p class="text-surface-600 mt-2">قم بملء النموذج أدناه لنشر وظيفة جديدة</p>
    </div>

    <!-- Form -->
    <form action="{{ route('jobs.listings.store') }}" method="POST" class="bg-white rounded-xl p-8 shadow-lg">
      @csrf

      <!-- Row 1: Main Type & Department -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Job Main Type -->
        <div>
          <label class="block text-sm font-bold text-surface-900 mb-2">
            نوع الوظيفة الرئيسي <span class="text-red-600">*</span>
          </label>
          <select name="job_main_type" class="w-full px-4 py-3 border border-surface-200 rounded-lg focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-100" required>
            <option value="">-- اختر نوع الوظيفة --</option>
             <option value="leadership">وظائف قيادية</option>
    <option value="professional">وظائف مهنية</option>
    <option value="administrative">وظائف إدارية</option>
          </select>
          @error('job_main_type')
            <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
          @enderror
        </div>

        <!-- Department/Category -->
        <div>
          <label class="block text-sm font-bold text-surface-900 mb-2">
            القسم/التخصص <span class="text-red-600">*</span>
          </label>
          <select name="job_category" class="w-full px-4 py-3 border border-surface-200 rounded-lg focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-100" required>
            <option value="">-- اختر القسم --</option>
            <optgroup label="تكنولوجيا والبرمجة">
              <option value="برمجة">برمجة</option>
              <option value="تطوير الويب">تطوير الويب</option>
              <option value="تطوير تطبيقات">تطوير تطبيقات</option>
              <option value="علوم البيانات">علوم البيانات</option>
              <option value="الذكاء الاصطناعي">الذكاء الاصطناعي</option>
              <option value="تكنولوجيا المعلومات">تكنولوجيا المعلومات</option>
            </optgroup>
            <optgroup label="الصحة والطب">
              <option value="تمريض">تمريض</option>
              <option value="الطب">الطب</option>
              <option value="صيدلة">صيدلة</option>
              <option value="أسنان">أسنان</option>
              <option value="العلاج الطبيعي">العلاج الطبيعي</option>
            </optgroup>
            <optgroup label="الهندسة">
              <option value="هندسة البرمجيات">هندسة البرمجيات</option>
              <option value="هندسة مدنية">هندسة مدنية</option>
              <option value="هندسة كهربائية">هندسة كهربائية</option>
              <option value="هندسة ميكانيكية">هندسة ميكانيكية</option>
              <option value="هندسة كيميائية">هندسة كيميائية</option>
            </optgroup>
            <optgroup label="الأعمال والتمويل">
              <option value="المحاسبة">المحاسبة</option>
              <option value="المالية">المالية</option>
              <option value="التسويق">التسويق</option>
              <option value="إدارة الأعمال">إدارة الأعمال</option>
              <option value="الموارد البشرية">الموارد البشرية</option>
            </optgroup>
            <optgroup label="التعليم">
              <option value="التعليم">التعليم</option>
              <option value="التدريب">التدريب</option>
            </optgroup>
            <optgroup label="البيع والخدمات">
              <option value="المبيعات">المبيعات</option>
              <option value="خدمة العملاء">خدمة العملاء</option>
              <option value="النقل واللوجستيات">النقل واللوجستيات</option>
            </optgroup>
          </select>
          @error('job_category')
            <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <!-- Row 2: Job Title & Work Type -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Job Title -->
        <div>
          <label class="block text-sm font-bold text-surface-900 mb-2">
            المسمى الوظيفي <span class="text-red-600">*</span>
          </label>
          <input type="text" name="title" class="w-full px-4 py-3 border border-surface-200 rounded-lg focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-100" placeholder="مثال: مهندس برمجيات أول" required>
          @error('title')
            <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
          @enderror
        </div>

        <!-- Work Type -->
        <div>
          <label class="block text-sm font-bold text-surface-900 mb-2">
            نوع الدوام <span class="text-red-600">*</span>
          </label>
          <select name="job_type" class="w-full px-4 py-3 border border-surface-200 rounded-lg focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-100" required>
            <option value="">-- اختر نوع الدوام --</option>
            <option value="full_time">دوام كامل</option>
    <option value="part_time">دوام جزئي</option>
    <option value="remote">عن بعد</option>
    <option value="freelance">عمل حر</option>
    <option value="training">تدريب</option>
          </select>
          @error('job_type')
            <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <!-- Row 3: Experience Level & Positions -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Experience Level -->
        <div>
          <label class="block text-sm font-bold text-surface-900 mb-2">
            مستوى الخبرة <span class="text-red-600">*</span>
          </label>
          <select name="experience_level" class="w-full px-4 py-3 border border-surface-200 rounded-lg focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-100" required>
            <option value="">-- اختر مستوى الخبرة --</option>
              <option value="entry">مبتدئ</option>
    <option value="mid">متوسط</option>
    <option value="senior">خبير</option>
    <option value="executive">تنفيذي</option>
          </select>
          @error('experience_level')
            <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
          @enderror
        </div>

        <!-- Positions Available -->
        <div>
          <label class="block text-sm font-bold text-surface-900 mb-2">
            عدد الوظائف المتاحة <span class="text-red-600">*</span>
          </label>
          <input type="number" name="positions_available" min="1" class="w-full px-4 py-3 border border-surface-200 rounded-lg focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-100" placeholder="عدد الوظائف" required>
          @error('positions_available')
            <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <!-- Row 4: Salary Range -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Salary Min -->
        <div>
          <label class="block text-sm font-bold text-surface-900 mb-2">
            الحد الأدنى للراتب
          </label>
          <input type="number" name="salary_min" min="0" class="w-full px-4 py-3 border border-surface-200 rounded-lg focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-100" placeholder="مثال: 3000">
          @error('salary_min')
            <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
          @enderror
        </div>

        <!-- Salary Max -->
        <div>
          <label class="block text-sm font-bold text-surface-900 mb-2">
            الحد الأقصى للراتب
          </label>
          <input type="number" name="salary_max" min="0" class="w-full px-4 py-3 border border-surface-200 rounded-lg focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-100" placeholder="مثال: 8000">
          @error('salary_max')
            <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <!-- Row 5: Location & Deadline -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Location -->
        <div>
          <label class="block text-sm font-bold text-surface-900 mb-2">
            الموقع <span class="text-red-600">*</span>
          </label>
          <input type="text" name="location" class="w-full px-4 py-3 border border-surface-200 rounded-lg focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-100" placeholder="مثال: الرياض - السعودية" required>
          @error('location')
            <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
          @enderror
        </div>

        <!-- Deadline -->
        <div>
          <label class="block text-sm font-bold text-surface-900 mb-2">
            آخر موعد للتقديم
          </label>
          <input type="date" name="deadline" class="w-full px-4 py-3 border border-surface-200 rounded-lg focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-100">
          @error('deadline')
            <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <!-- Description -->
      <div class="mb-6">
        <label class="block text-sm font-bold text-surface-900 mb-2">
          وصف الوظيفة <span class="text-red-600">*</span>
        </label>
        <textarea name="description" rows="6" class="w-full px-4 py-3 border border-surface-200 rounded-lg focus:outline-none focus:border-brand-600 focus:ring-2 focus:ring-brand-100" placeholder="قم بوصف الوظيفة والمتطلبات بشكل مفصل..." required></textarea>
        @error('description')
          <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
        @enderror
      </div>

      <!-- Required Skills -->
      <div class="mb-6">
        <label class="block text-sm font-bold text-surface-900 mb-2">
          المهارات المطلوبة
        </label>
        <div class="space-y-2">
          <div id="skills-container" class="space-y-2">
            <div class="flex gap-2">
              <input type="text" placeholder="أضف مهارة..." class="flex-1 px-4 py-2 border border-surface-200 rounded-lg focus:outline-none focus:border-brand-600 skill-input">
              <button type="button" onclick="addSkillField()" class="px-4 py-2 bg-brand-600 text-white rounded-lg hover:bg-brand-700 transition">
                + إضافة
              </button>
            </div>
          </div>
        </div>
        <input type="hidden" name="required_skills" id="skills-hidden">
        @error('required_skills')
          <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
        @enderror
      </div>

      <!-- Languages -->
      <div class="mb-6">
        <label class="block text-sm font-bold text-surface-900 mb-2">
          اللغات المطلوبة
        </label>
        <div class="space-y-2">
          <div id="languages-container" class="space-y-2">
            <div class="flex gap-2">
              <input type="text" placeholder="أضف لغة..." class="flex-1 px-4 py-2 border border-surface-200 rounded-lg focus:outline-none focus:border-brand-600 language-input">
              <button type="button" onclick="addLanguageField()" class="px-4 py-2 bg-brand-600 text-white rounded-lg hover:bg-brand-700 transition">
                + إضافة
              </button>
            </div>
          </div>
        </div>
        <input type="hidden" name="languages" id="languages-hidden">
        @error('languages')
          <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
        @enderror
      </div>

      <!-- Benefits -->
      <div class="mb-6">
        <label class="block text-sm font-bold text-surface-900 mb-2">
          المميزات والمزايا
        </label>
        <div class="space-y-2">
          <div id="benefits-container" class="space-y-2">
            <div class="flex gap-2">
              <input type="text" placeholder="أضف مزية..." class="flex-1 px-4 py-2 border border-surface-200 rounded-lg focus:outline-none focus:border-brand-600 benefit-input">
              <button type="button" onclick="addBenefitField()" class="px-4 py-2 bg-brand-600 text-white rounded-lg hover:bg-brand-700 transition">
                + إضافة
              </button>
            </div>
          </div>
        </div>
        <input type="hidden" name="benefits" id="benefits-hidden">
        @error('benefits')
          <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
        @enderror
      </div>

      <!-- Buttons -->
      <div class="flex gap-4">
        <button type="submit" class="px-8 py-3 bg-brand-600 text-white font-bold rounded-lg hover:bg-brand-700 transition">
          نشر الوظيفة
        </button>
        <a href="" class="px-8 py-3 bg-gray-200 text-gray-800 font-bold rounded-lg hover:bg-gray-300 transition">
          إلغاء
        </a>
      </div>
    </form>
  </div>
</div>

<script>
  function addSkillField() {
    const container = document.getElementById('skills-container');
    const newField = document.createElement('div');
    newField.className = 'flex gap-2';
    newField.innerHTML = `
      <input type="text" placeholder="أضف مهارة..." class="flex-1 px-4 py-2 border border-surface-200 rounded-lg focus:outline-none focus:border-brand-600 skill-input">
      <button type="button" onclick="this.parentElement.remove(); updateSkills()" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
        حذف
      </button>
    `;
    container.appendChild(newField);
  }

  function addLanguageField() {
    const container = document.getElementById('languages-container');
    const newField = document.createElement('div');
    newField.className = 'flex gap-2';
    newField.innerHTML = `
      <input type="text" placeholder="أضف لغة..." class="flex-1 px-4 py-2 border border-surface-200 rounded-lg focus:outline-none focus:border-brand-600 language-input">
      <button type="button" onclick="this.parentElement.remove(); updateLanguages()" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
        حذف
      </button>
    `;
    container.appendChild(newField);
  }

  function addBenefitField() {
    const container = document.getElementById('benefits-container');
    const newField = document.createElement('div');
    newField.className = 'flex gap-2';
    newField.innerHTML = `
      <input type="text" placeholder="أضف مزية..." class="flex-1 px-4 py-2 border border-surface-200 rounded-lg focus:outline-none focus:border-brand-600 benefit-input">
      <button type="button" onclick="this.parentElement.remove(); updateBenefits()" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
        حذف
      </button>
    `;
    container.appendChild(newField);
  }

  function updateSkills() {
    const skills = Array.from(document.querySelectorAll('.skill-input'))
      .map(input => input.value.trim())
      .filter(value => value);
    document.getElementById('skills-hidden').value = JSON.stringify(skills);
  }

  function updateLanguages() {
    const languages = Array.from(document.querySelectorAll('.language-input'))
      .map(input => input.value.trim())
      .filter(value => value);
    document.getElementById('languages-hidden').value = JSON.stringify(languages);
  }

  function updateBenefits() {
    const benefits = Array.from(document.querySelectorAll('.benefit-input'))
      .map(input => input.value.trim())
      .filter(value => value);
    document.getElementById('benefits-hidden').value = JSON.stringify(benefits);
  }

  // Update hidden fields on form submission
  document.querySelector('form').addEventListener('submit', function() {
    updateSkills();
    updateLanguages();
    updateBenefits();
  });
</script>

@endsection
