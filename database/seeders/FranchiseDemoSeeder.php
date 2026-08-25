<?php

namespace Database\Seeders;

use App\Models\FranchiseOpportunity;
use App\Models\FranchiseOpportunityStep;
use Illuminate\Database\Seeder;

class FranchiseDemoSeeder extends Seeder
{
    public function run(): void
    {
        // Demo 1 — بن زيد للقهوة العربية
        $bz = FranchiseOpportunity::create([
            'name'                  => 'بن زيد للقهوة العربية',
            'name_en'               => 'Bin Zaid Arabic Coffee',
            'category'              => 'food',
            'description'           => 'سلسلة قهوة سعودية أصيلة بنكهة عربية معاصرة، تمتلك أكثر من 30 فرعاً في المملكة وتعمل على التوسع المستمر لتغطية جميع مناطق المملكة.',
            'icon'                  => 'fa-coffee',
            'gradient_from'         => '#92400e',
            'gradient_to'           => '#d97706',
            'badge_text'            => 'الأكثر طلباً',
            'investment_min'        => 250000,
            'investment_max'        => 500000,
            'roi_months_min'        => 18,
            'roi_months_max'        => 24,
            'franchise_fee_percent' => 5.0,
            'available_regions'     => ['الرياض', 'جدة', 'الدمام'],
            'requirements'          => ['خبرة في قطاع الأغذية', 'مساحة 40-80م²', 'سجل تجاري ساري', 'رأس مال جاهز'],
            'status'                => 'active',
            'is_featured'           => true,
            'sort_order'            => 1,
        ]);

        foreach ([
            ['تقديم الطلب الإلكتروني',  'رفع نموذج الطلب عبر المنصة مع المستندات المطلوبة.',    'fa-paper-plane'],
            ['مراجعة الملف',            'يراجع فريقنا ملفك خلال 3-5 أيام عمل.',                  'fa-search'],
            ['المقابلة والتقييم',        'مقابلة مع المختصين لتقييم الأهلية والموقع المقترح.',     'fa-users'],
            ['توقيع عقد الامتياز',      'توقيع العقد الرسمي وتسديد رسوم الامتياز الأولية.',       'fa-file-contract'],
            ['التدريب والتهيئة',         'برنامج تدريبي مكثف على العمليات والمنتجات لمدة أسبوعين.','fa-chalkboard-teacher'],
            ['الافتتاح الرسمي',          'دعم كامل من الفريق في يوم الافتتاح وما بعده.',            'fa-store'],
        ] as $i => [$title, $desc, $icon]) {
            FranchiseOpportunityStep::create([
                'opportunity_id' => $bz->id,
                'title'          => $title,
                'description'    => $desc,
                'icon'           => $icon,
                'sort_order'     => $i,
            ]);
        }

        // Demo 2 — أكاديمية المستقبل
        $am = FranchiseOpportunity::create([
            'name'                  => 'أكاديمية المستقبل',
            'name_en'               => 'Future Academy',
            'category'              => 'edu',
            'description'           => 'مراكز تعليمية متكاملة للأطفال والشباب تقدم برامج ترميز، مهارات رقمية، وذكاء اصطناعي بأسلوب تفاعلي وممتع.',
            'icon'                  => 'fa-graduation-cap',
            'gradient_from'         => '#1d4ed8',
            'gradient_to'           => '#3b82f6',
            'badge_text'            => 'جديد',
            'investment_min'        => 150000,
            'investment_max'        => 300000,
            'roi_months_min'        => 12,
            'roi_months_max'        => 18,
            'franchise_fee_percent' => 8.0,
            'available_regions'     => ['جميع المناطق'],
            'requirements'          => ['مساحة 80-150م²', 'موقع حيوي بالقرب من المدارس', 'فريق تعليمي مؤهل', 'سجل تجاري'],
            'status'                => 'active',
            'is_featured'           => false,
            'sort_order'            => 2,
        ]);

        foreach ([
            ['تعبئة استمارة الطلب',     'إرسال الطلب مع السيرة الذاتية ومعلومات الموقع.',         'fa-clipboard'],
            ['مراجعة الطلب',            'مراجعة الأهلية ومدى ملاءمة الموقع للأكاديمية.',           'fa-check-double'],
            ['جلسة التوجيه',            'جلسة توجيه شاملة عن نظام الأكاديمية ومعايير الجودة.',     'fa-chalkboard'],
            ['توقيع العقد والدفع',       'توقيع عقد الامتياز ودفع رسوم الانضمام.',                 'fa-handshake'],
            ['إعداد الفرع',             'مساعدة في تجهيز الفصول والمعدات والمحتوى التعليمي.',      'fa-tools'],
            ['الافتتاح والمتابعة',       'انطلاق الأكاديمية مع دعم مستمر وتقييمات دورية.',         'fa-rocket'],
        ] as $i => [$title, $desc, $icon]) {
            FranchiseOpportunityStep::create([
                'opportunity_id' => $am->id,
                'title'          => $title,
                'description'    => $desc,
                'icon'           => $icon,
                'sort_order'     => $i,
            ]);
        }
    }
}
