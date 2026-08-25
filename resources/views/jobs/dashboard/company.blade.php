@extends('jobs.layouts.app')

@section('title', 'لوحة تحكم الشركة - وظّفني')

@section('content')
<div class="min-h-screen bg-surface-50 py-12">
  <div class="max-w-7xl mx-auto px-6">
    <!-- Header -->
    <div class="mb-8">
      <h1 class="text-4xl font-bold text-surface-900">مرحباً {{ auth()->user()->name }}! 👋</h1>
      <p class="text-surface-600 mt-2">إدارة وظائفك وتطبيقات المرشحين</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
      <div class="bg-white rounded-xl p-6 border-l-4 border-brand-600">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-600 text-sm">إجمالي الوظائف</p>
            <p class="text-3xl font-bold text-surface-900">{{ $company->jobs()->count() ?? 0 }}</p>
          </div>
          <i data-lucide="briefcase" class="w-12 h-12 text-brand-600 opacity-20"></i>
        </div>
      </div>

      <div class="bg-white rounded-xl p-6 border-l-4 border-emerald-600">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-600 text-sm">التطبيقات</p>
            <p class="text-3xl font-bold text-surface-900">{{ $applications_count ?? 0 }}</p>
          </div>
          <i data-lucide="file-text" class="w-12 h-12 text-emerald-600 opacity-20"></i>
        </div>
      </div>

      <div class="bg-white rounded-xl p-6 border-l-4 border-amber-600">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-600 text-sm">التقييم</p>
            <p class="text-3xl font-bold text-surface-900">{{ round($company->rating ?? 0, 1) }}/5</p>
          </div>
          <i data-lucide="star" class="w-12 h-12 text-amber-600 opacity-20"></i>
        </div>
      </div>

      <div class="bg-white rounded-xl p-6 border-l-4 border-pink-600">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-gray-600 text-sm">التقييمات</p>
            <p class="text-3xl font-bold text-surface-900">{{ $company->reviews_count ?? 0 }}</p>
          </div>
          <i data-lucide="message-square" class="w-12 h-12 text-pink-600 opacity-20"></i>
        </div>
      </div>
    </div>

    <!-- Actions -->
    <div class="flex flex-wrap gap-4 mb-8">
      <a href="{{ route('jobs.listings.create') }}" class="px-6 py-3 bg-brand-600 text-white font-bold rounded-lg hover:bg-brand-700 transition flex items-center gap-2">
        <i data-lucide="plus" class="w-5 h-5"></i>
        نشر وظيفة جديدة
      </a>
      <a href="{{ route('jobs.company.profile') }}" class="px-6 py-3 bg-gray-200 text-gray-800 font-bold rounded-lg hover:bg-gray-300 transition">
        عرض الملف الشخصي
      </a>
    </div>

    <!-- Tabs Navigation -->
    <div class="flex gap-4 mb-6 border-b border-gray-200">
      <button class="tab-btn active px-4 py-3 text-brand-600 font-bold border-b-2 border-brand-600" data-tab="jobs">
        <i data-lucide="briefcase" class="w-4 h-4 inline mr-2"></i>
        الوظائف
      </button>
      <button class="tab-btn px-4 py-3 text-gray-600 font-bold border-b-2 border-transparent hover:text-brand-600" data-tab="applications">
        <i data-lucide="inbox" class="w-4 h-4 inline mr-2"></i>
        التطبيقات
      </button>
      <button class="tab-btn px-4 py-3 text-gray-600 font-bold border-b-2 border-transparent hover:text-brand-600" data-tab="reviews">
        <i data-lucide="star" class="w-4 h-4 inline mr-2"></i>
        التقييمات
      </button>
    </div>

    <!-- Tab Content -->

    <!-- Jobs Tab -->
    <div id="jobs-tab" class="tab-content bg-white rounded-xl p-6 mb-8">
      <h2 class="text-2xl font-bold text-surface-900 mb-6">أحدث الوظائف</h2>
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-surface-50">
            <tr>
              <th class="px-4 py-3 text-right text-sm font-bold text-surface-900">المسمى الوظيفي</th>
              <th class="px-4 py-3 text-right text-sm font-bold text-surface-900">النوع</th>
              <th class="px-4 py-3 text-right text-sm font-bold text-surface-900">التطبيقات</th>
              <th class="px-4 py-3 text-right text-sm font-bold text-surface-900">الحالة</th>
              <th class="px-4 py-3 text-right text-sm font-bold text-surface-900">التاريخ</th>
              <th class="px-4 py-3 text-center text-sm font-bold text-surface-900">الإجراءات</th>
            </tr>
          </thead>
          <tbody>
            @forelse($company->jobs()->latest()->limit(10)->get() ?? [] as $job)
            <tr class="border-b border-gray-200 hover:bg-surface-50 transition">
              <td class="px-4 py-4 text-sm text-surface-900 font-medium">{{ $job->title }}</td>
              <td class="px-4 py-4 text-sm text-surface-700">
                <span class="inline-block px-2 py-1 bg-blue-100 text-blue-700 text-xs rounded">
                  {{ $job->job_type ?? 'N/A' }}
                </span>
              </td>
              <td class="px-4 py-4 text-sm text-surface-900">
                <span class="font-bold text-brand-600">{{ $job->applications()->count() }}</span>
              </td>
              <td class="px-4 py-4 text-sm">
                <span class="px-3 py-1 rounded-full text-xs font-bold 
                  {{ $job->status === 'active' ? 'bg-green-100 text-green-800' : ($job->status === 'closed' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800') }}">
                  {{ $job->status === 'active' ? 'نشطة' : ($job->status === 'closed' ? 'مغلقة' : $job->status) }}
                </span>
              </td>
              <td class="px-4 py-4 text-sm text-gray-600">{{ $job->created_at->format('Y-m-d') }}</td>
              <td class="px-4 py-4 text-center text-sm">
                <div class="flex gap-2 justify-center">
                  <a href="{{ route('jobs.listings.edit', $job->id) }}" class="text-blue-600 hover:text-blue-800" title="تعديل">
                    <i data-lucide="edit" class="w-4 h-4"></i>
                  </a>
                  <a href="{{ route('jobs.listings.show', $job->id) }}" class="text-green-600 hover:text-green-800" title="عرض">
                    <i data-lucide="eye" class="w-4 h-4"></i>
                  </a>
                  <button onclick="deleteJob({{ $job->id }})" class="text-red-600 hover:text-red-800" title="حذف">
                    <i data-lucide="trash" class="w-4 h-4"></i>
                  </button>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="px-4 py-12 text-center text-gray-600">
                <div class="flex flex-col items-center gap-4">
                  <i data-lucide="inbox" class="w-12 h-12 text-gray-300"></i>
                  <p>لم تنشر أي وظائف بعد</p>
                  <a href="{{ route('jobs.listings.create') }}" class="text-brand-600 hover:text-brand-700 font-bold">نشر وظيفة الآن</a>
                </div>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- Applications Tab -->
    <div id="applications-tab" class="tab-content hidden bg-white rounded-xl p-6 mb-8">
      <h2 class="text-2xl font-bold text-surface-900 mb-6">التطبيقات الأخيرة</h2>
      <div class="space-y-4">
        @if(isset($recent_applications) && count($recent_applications) > 0)
          @foreach($recent_applications as $application)
          <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
            <div class="flex items-center justify-between mb-2">
              <div>
                <h3 class="font-bold text-surface-900">{{ $application->applicant_name ?? 'متقدم' }}</h3>
                <p class="text-sm text-gray-600">{{ $application->job->title ?? 'وظيفة' }} - {{ $application->created_at->format('Y-m-d') }}</p>
              </div>
              <span class="px-3 py-1 rounded-full text-xs font-bold 
                {{ $application->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($application->status === 'accepted' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                {{ $application->status }}
              </span>
            </div>
            <p class="text-sm text-gray-700 mb-3">{{ substr($application->message ?? 'لا توجد رسالة', 0, 100) }}...</p>
            <div class="flex gap-2">
              <a href="mailto:{{ $application->applicant_email }}" class="text-brand-600 hover:text-brand-700 text-sm font-bold">
                <i data-lucide="mail" class="w-4 h-4 inline mr-1"></i>
                إرسال بريد
              </a>
              <a href="#" class="text-green-600 hover:text-green-700 text-sm font-bold">
                <i data-lucide="check" class="w-4 h-4 inline mr-1"></i>
                قبول
              </a>
              <a href="#" class="text-red-600 hover:text-red-700 text-sm font-bold">
                <i data-lucide="x" class="w-4 h-4 inline mr-1"></i>
                رفض
              </a>
            </div>
          </div>
          @endforeach
        @else
        <div class="text-center py-12">
          <i data-lucide="inbox" class="w-12 h-12 mx-auto text-gray-300 mb-4"></i>
          <p class="text-gray-600">لم تتلقَ أي تطبيقات بعد</p>
        </div>
        @endif
      </div>
    </div>

    <!-- Reviews Tab -->
    <div id="reviews-tab" class="tab-content hidden bg-white rounded-xl p-6 mb-8">
      <h2 class="text-2xl font-bold text-surface-900 mb-6">التقييمات والآراء</h2>
      <div class="space-y-4">
        @if(isset($reviews) && count($reviews) > 0)
          @foreach($reviews as $review)
          <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
            <div class="flex items-start justify-between mb-2">
              <div>
                <div class="flex items-center gap-2 mb-1">
                  <h3 class="font-bold text-surface-900">{{ $review->reviewer_name ?? 'مستخدم' }}</h3>
                  <div class="flex text-amber-400">
                    @for($i = 0; $i < 5; $i++)
                      <i data-lucide="star" class="w-3 h-3 {{ $i < $review->rating ? 'fill-current' : '' }}"></i>
                    @endfor
                  </div>
                </div>
                <p class="text-xs text-gray-600">{{ $review->created_at->format('Y-m-d H:i') }}</p>
              </div>
            </div>
            <p class="text-sm text-gray-700">{{ $review->comment }}</p>
          </div>
          @endforeach
        @else
        <div class="text-center py-12">
          <i data-lucide="star" class="w-12 h-12 mx-auto text-gray-300 mb-4"></i>
          <p class="text-gray-600">لم تتلقَ أي تقييمات بعد</p>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>

<!-- Delete Job Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white rounded-lg p-6 max-w-sm mx-4">
    <h3 class="text-xl font-bold text-surface-900 mb-2">حذف الوظيفة</h3>
    <p class="text-gray-600 mb-6">هل أنت متأكد من حذف هذه الوظيفة؟ هذا الإجراء لا يمكن التراجع عنه.</p>
    <div class="flex gap-3">
      <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2 bg-gray-200 text-gray-800 font-bold rounded-lg hover:bg-gray-300">
        إلغاء
      </button>
      <button id="confirmDelete" class="flex-1 px-4 py-2 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700">
        حذف
      </button>
    </div>
  </div>
</div>

<script>
  let jobToDelete = null;

  // Tab Switching
  document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      const tabName = this.dataset.tab;
      
      // Hide all tabs
      document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.add('hidden');
      });
      
      // Remove active class from all buttons
      document.querySelectorAll('.tab-btn').forEach(b => {
        b.classList.remove('text-brand-600', 'border-brand-600');
        b.classList.add('text-gray-600', 'border-transparent');
      });
      
      // Show selected tab
      document.getElementById(tabName + '-tab').classList.remove('hidden');
      
      // Add active class to button
      this.classList.add('text-brand-600', 'border-brand-600');
      this.classList.remove('text-gray-600', 'border-transparent');
    });
  });

  function deleteJob(jobId) {
    jobToDelete = jobId;
    document.getElementById('deleteModal').classList.remove('hidden');
  }

  function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    jobToDelete = null;
  }

  document.getElementById('confirmDelete')?.addEventListener('click', function() {
    if (jobToDelete) {
      fetch(`/jobs/${jobToDelete}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
          'Content-Type': 'application/json'
        }
      })
      .then(response => {
        if (response.ok) {
          location.reload();
        }
      })
      .catch(error => console.error('Error:', error));
    }
  });

  // Close modal when clicking outside
  document.getElementById('deleteModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
      closeDeleteModal();
    }
  });
</script>

@endsection
