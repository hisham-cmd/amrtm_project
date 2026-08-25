<?php

namespace Database\Seeders;

use App\Models\FranchiseBrand;
use App\Models\FranchiseAuction;
use App\Models\FranchiseBid;
use App\Models\FranchiseOpportunity;
use App\Models\FranchiseOpportunityStep;
use App\Models\PageSlider;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProductionDemoSeeder extends Seeder
{
    public function run(): void
    {
        // ── Demo investor users for bid history ──────────────────────────────
        $investors = [];
        $investorData = [
            ['name' => 'عبدالرحمن المطيري', 'email' => 'investor1@demo.sa'],
            ['name' => 'محمد الغامدي',       'email' => 'investor2@demo.sa'],
            ['name' => 'فيصل العتيبي',        'email' => 'investor3@demo.sa'],
            ['name' => 'خالد الشهري',          'email' => 'investor4@demo.sa'],
        ];
        foreach ($investorData as $d) {
            $investors[] = User::firstOrCreate(
                ['email' => $d['email']],
                ['name' => $d['name'], 'phone' => '05' . rand(10000000, 99999999), 'role' => 'user', 'password' => Hash::make('demo1234')]
            );
        }

        // ── Franchise Brands ─────────────────────────────────────────────────
        $brands = [
            [
                'name'                  => 'هرفي للوجبات السريعة',
                'name_en'               => 'Herfy Fast Food',
                'category'              => 'food',
                'description'           => 'سلسلة وجبات سريعة سعودية رائدة تأسست عام 1983، تمتلك أكثر من 400 فرع في المملكة وتعد من أكبر سلاسل الوجبات السريعة المحلية.',
                'investment_min'        => 800000,
                'investment_max'        => 1500000,
                'roi_months_min'        => 24,
                'roi_months_max'        => 36,
                'franchise_fee_percent' => 6.0,
                'available_regions'     => ['الرياض', 'جدة', 'الدمام', 'مكة المكرمة'],
                'requirements'          => ['خبرة في إدارة المطاعم', 'مساحة 150-300م²', 'سجل تجاري ساري', 'رأس مال كافٍ'],
                'is_featured'           => true,
                'is_auction_eligible'   => true,
                'status'                => 'active',
                'sort_order'            => 1,
            ],
            [
                'name'                  => 'مطاعم البيك',
                'name_en'               => 'Al Baik Restaurants',
                'category'              => 'food',
                'description'           => 'علامة الدجاج المقلي الأشهر في المملكة، حضور في 30 مدينة بأكثر من 120 فرعاً وقاعدة عملاء ضخمة.',
                'investment_min'        => 1200000,
                'investment_max'        => 2500000,
                'roi_months_min'        => 30,
                'roi_months_max'        => 48,
                'franchise_fee_percent' => 5.5,
                'available_regions'     => ['جدة', 'مكة المكرمة', 'المدينة المنورة', 'الطائف'],
                'requirements'          => ['مساحة 200-400م²', 'موقع مميز', 'خبرة في قطاع الأغذية', 'قدرة تشغيلية عالية'],
                'is_featured'           => true,
                'is_auction_eligible'   => true,
                'status'                => 'active',
                'sort_order'            => 2,
            ],
            [
                'name'                  => 'أكاديمية إبداع للتعليم',
                'name_en'               => 'Ibda Academy',
                'category'              => 'edu',
                'description'           => 'مراكز تعليمية متخصصة في تنمية المواهب وتعليم البرمجة والرياضيات للأطفال والناشئين بأساليب تفاعلية حديثة.',
                'investment_min'        => 350000,
                'investment_max'        => 650000,
                'roi_months_min'        => 12,
                'roi_months_max'        => 18,
                'franchise_fee_percent' => 8.0,
                'available_regions'     => ['الرياض', 'جدة', 'الدمام', 'أبها', 'القصيم'],
                'requirements'          => ['مساحة 100-200م²', 'موقع سكني أو تجاري', 'فريق تعليمي مؤهل'],
                'is_featured'           => false,
                'is_auction_eligible'   => false,
                'status'                => 'active',
                'sort_order'            => 3,
            ],
            [
                'name'                  => 'نادي فيتنس تايم',
                'name_en'               => 'Fitness Time Club',
                'category'              => 'fitness',
                'description'           => 'أكبر سلسلة نوادٍ رياضية في المملكة بأكثر من 130 فرعاً، تقدم خدمات لياقة شاملة للرجال والنساء بمعايير عالمية.',
                'investment_min'        => 2000000,
                'investment_max'        => 5000000,
                'roi_months_min'        => 36,
                'roi_months_max'        => 60,
                'franchise_fee_percent' => 4.5,
                'available_regions'     => ['الرياض', 'جدة', 'الدمام', 'مكة المكرمة', 'المدينة المنورة'],
                'requirements'          => ['مساحة 800-2000م²', 'تجهيزات رياضية عالية الجودة', 'طاقم تدريب معتمد'],
                'is_featured'           => false,
                'is_auction_eligible'   => true,
                'status'                => 'active',
                'sort_order'            => 4,
            ],
            [
                'name'                  => 'سهل تك للحلول الرقمية',
                'name_en'               => 'Sahl Tech Solutions',
                'category'              => 'tech',
                'description'           => 'مراكز خدمات تقنية متكاملة تقدم حلول للأفراد والشركات الصغيرة: صيانة أجهزة، أمن معلومات، برمجة وتطوير.',
                'investment_min'        => 150000,
                'investment_max'        => 300000,
                'roi_months_min'        => 8,
                'roi_months_max'        => 14,
                'franchise_fee_percent' => 7.0,
                'available_regions'     => ['الرياض', 'جدة', 'الدمام', 'أبها', 'حائل', 'القصيم'],
                'requirements'          => ['مساحة 50-100م²', 'موقع تجاري', 'خلفية تقنية أساسية'],
                'is_featured'           => false,
                'is_auction_eligible'   => false,
                'status'                => 'active',
                'sort_order'            => 5,
            ],
        ];

        $createdBrands = [];
        foreach ($brands as $brandData) {
            $createdBrands[] = FranchiseBrand::create($brandData);
        }

        // ── Active Auctions with Bid History ────────────────────────────────
        $auctionConfigs = [
            [
                'brand_index'    => 0, // هرفي
                'starting_bid'   => 1500000,
                'current_bid'    => 2150000,
                'reserve_price'  => 3000000,
                'increment'      => 50000,
                'deposit'        => 150000,
                'ends_at'        => now()->addDays(6)->addHours(14),
                'bids'           => [
                    ['user_index' => 0, 'amount' => 1500000, 'hours_ago' => 72],
                    ['user_index' => 1, 'amount' => 1600000, 'hours_ago' => 60],
                    ['user_index' => 2, 'amount' => 1800000, 'hours_ago' => 48],
                    ['user_index' => 0, 'amount' => 1900000, 'hours_ago' => 36],
                    ['user_index' => 3, 'amount' => 2050000, 'hours_ago' => 20],
                    ['user_index' => 1, 'amount' => 2150000, 'hours_ago' => 4],
                ],
            ],
            [
                'brand_index'    => 1, // البيك
                'starting_bid'   => 2500000,
                'current_bid'    => 3200000,
                'reserve_price'  => 5000000,
                'increment'      => 100000,
                'deposit'        => 250000,
                'ends_at'        => now()->addDays(3)->addHours(8),
                'bids'           => [
                    ['user_index' => 2, 'amount' => 2500000, 'hours_ago' => 96],
                    ['user_index' => 0, 'amount' => 2700000, 'hours_ago' => 72],
                    ['user_index' => 3, 'amount' => 2900000, 'hours_ago' => 48],
                    ['user_index' => 1, 'amount' => 3100000, 'hours_ago' => 12],
                    ['user_index' => 2, 'amount' => 3200000, 'hours_ago' => 2],
                ],
            ],
            [
                'brand_index'    => 3, // فيتنس تايم
                'starting_bid'   => 3500000,
                'current_bid'    => 3500000,
                'reserve_price'  => 8000000,
                'increment'      => 100000,
                'deposit'        => 300000,
                'ends_at'        => now()->addDays(12)->addHours(6),
                'bids'           => [],
            ],
        ];

        foreach ($auctionConfigs as $cfg) {
            $brand = $createdBrands[$cfg['brand_index']];
            $auction = FranchiseAuction::create([
                'brand_id'         => $brand->id,
                'title'            => 'مزاد حقوق الامتياز — ' . $brand->name,
                'description'      => 'فرصة نادرة للحصول على حقوق الامتياز الكاملة لـ ' . $brand->name . ' في منطقة استراتيجية.',
                'starting_bid'     => $cfg['starting_bid'],
                'current_bid'      => $cfg['current_bid'],
                'reserve_price'    => $cfg['reserve_price'],
                'increment_amount' => $cfg['increment'],
                'deposit_amount'   => $cfg['deposit'],
                'bids_count'       => count($cfg['bids']),
                'status'           => 'active',
                'starts_at'        => now()->subDays(5),
                'ends_at'          => $cfg['ends_at'],
            ]);

            // Create bid history
            $latestBidUserId = null;
            foreach ($cfg['bids'] as $bidData) {
                $user = $investors[$bidData['user_index']];
                FranchiseBid::create([
                    'auction_id'  => $auction->id,
                    'user_id'     => $user->id,
                    'amount'      => $bidData['amount'],
                    'status'      => 'active',
                    'deposit_ref' => 'DEP-' . strtoupper(substr(md5($auction->id . $user->id . $bidData['amount']), 0, 8)),
                    'created_at'  => now()->subHours($bidData['hours_ago']),
                    'updated_at'  => now()->subHours($bidData['hours_ago']),
                ]);
                $latestBidUserId = $user->id;
            }

            // Mark older bids as outbid
            if ($latestBidUserId && count($cfg['bids']) > 1) {
                FranchiseBid::where('auction_id', $auction->id)
                    ->where('amount', '<', $cfg['current_bid'])
                    ->update(['status' => 'outbid']);
            }
        }

        // ── Page Sliders ─────────────────────────────────────────────────────
        $sliders = [
            [
                'title'      => 'منصة الامتياز التجاري السعودية',
                'subtitle'   => 'أول منصة معتمدة من هيئة الملكية الفكرية SAIP لبيع وشراء حقوق الامتياز',
                'image_path' => 'sliders/placeholder-1.jpg',
                'link_url'   => '/brands-auction',
                'link_text'  => 'استعرض الفرص',
                'is_active'  => true,
                'sort_order' => 1,
            ],
            [
                'title'      => 'مزادات حقوق الامتياز',
                'subtitle'   => 'زايد على علامتك التجارية المفضلة وابنِ إمبراطوريتك التجارية',
                'image_path' => 'sliders/placeholder-2.jpg',
                'link_url'   => '/brands-auction#auctions',
                'link_text'  => 'المزادات النشطة',
                'is_active'  => true,
                'sort_order' => 2,
            ],
            [
                'title'      => 'فرص الامتياز الحصرية',
                'subtitle'   => 'أكثر من 50 علامة تجارية موثقة تنتظر شريك النجاح',
                'image_path' => 'sliders/placeholder-3.jpg',
                'link_url'   => '/brands-auction#franchises',
                'link_text'  => 'اكتشف الامتيازات',
                'is_active'  => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($sliders as $sd) {
            PageSlider::create($sd);
        }

        // ── Enhance Franchise Opportunities with more entries ─────────────
        $additionalOpps = [
            [
                'name'                  => 'مطاعم كودو',
                'name_en'               => 'Kudu Restaurants',
                'category'              => 'food',
                'description'           => 'سلسلة مطاعم برغر سعودية متوسطة الحجم تضم 200+ فرع، تشتهر بوجبات ذات جودة عالية وأسعار تنافسية.',
                'icon'                  => 'fa-hamburger',
                'gradient_from'         => '#b91c1c',
                'gradient_to'           => '#ef4444',
                'badge_text'            => 'رائج',
                'investment_min'        => 400000,
                'investment_max'        => 800000,
                'roi_months_min'        => 18,
                'roi_months_max'        => 28,
                'franchise_fee_percent' => 6.0,
                'available_regions'     => ['الرياض', 'جدة', 'الدمام', 'مكة المكرمة', 'المدينة المنورة', 'أبها'],
                'requirements'          => ['مساحة 80-160م²', 'موقع مميز', 'سجل تجاري ساري'],
                'status'                => 'active',
                'is_featured'           => true,
                'sort_order'            => 3,
                'steps'                 => [
                    ['title' => 'تقديم الطلب الإلكتروني', 'desc' => 'أكمل نموذج التقديم بكافة بياناتك المالية والتشغيلية', 'icon' => 'fa-file-alt'],
                    ['title' => 'مقابلة تمهيدية', 'desc' => 'مقابلة عبر الفيديو مع فريق التوسع خلال 5 أيام عمل', 'icon' => 'fa-video'],
                    ['title' => 'دراسة الموقع', 'desc' => 'تقييم الموقع المقترح من قِبل فريق خبراء العقارات', 'icon' => 'fa-map-marker-alt'],
                    ['title' => 'توقيع العقد', 'desc' => 'مراجعة وتوقيع عقد الامتياز الموثق قانونياً', 'icon' => 'fa-file-signature'],
                    ['title' => 'التدريب والتأهيل', 'desc' => 'برنامج تدريبي مكثف لمدة 3 أسابيع في مراكز التدريب', 'icon' => 'fa-graduation-cap'],
                    ['title' => 'الافتتاح', 'desc' => 'دعم فريق متخصص في الافتتاح والأشهر الثلاثة الأولى', 'icon' => 'fa-store'],
                ],
            ],
            [
                'name'                  => 'صحة للعناية الطبية',
                'name_en'               => 'Sehha Medical Centers',
                'category'              => 'services',
                'description'           => 'مراكز عيادات طبية متكاملة تقدم خدمات الطب العام والتخصصي بأسعار ميسورة ضمن معايير الاعتماد الصحي السعودي.',
                'icon'                  => 'fa-heartbeat',
                'gradient_from'         => '#0d9488',
                'gradient_to'           => '#14b8a6',
                'badge_text'            => 'جديد',
                'investment_min'        => 1500000,
                'investment_max'        => 3000000,
                'roi_months_min'        => 30,
                'roi_months_max'        => 48,
                'franchise_fee_percent' => 4.0,
                'available_regions'     => ['الرياض', 'جدة', 'الدمام'],
                'requirements'          => ['رخصة مزاولة مهنة طبية', 'مساحة 200-500م²', 'طاقم طبي مرخص', 'اعتماد صحي'],
                'status'                => 'active',
                'is_featured'           => false,
                'sort_order'            => 5,
                'steps'                 => [
                    ['title' => 'تقديم الطلب', 'desc' => 'ملء نموذج الطلب مع الوثائق المطلوبة', 'icon' => 'fa-file-medical'],
                    ['title' => 'فحص الأهلية', 'desc' => 'التحقق من الشهادات والتراخيص والخبرات', 'icon' => 'fa-user-md'],
                    ['title' => 'الموافقة التنظيمية', 'desc' => 'استيفاء متطلبات وزارة الصحة والجهات الرقابية', 'icon' => 'fa-hospital'],
                    ['title' => 'التجهيز والتشغيل', 'desc' => 'إعداد المنشأة وتركيب الأنظمة الطبية والإدارية', 'icon' => 'fa-cog'],
                    ['title' => 'التدريب', 'desc' => 'تدريب الكادر الطبي والإداري على معايير الجودة', 'icon' => 'fa-chalkboard-teacher'],
                    ['title' => 'الافتتاح الرسمي', 'desc' => 'إطلاق المركز بدعم فريق الشركة الأم', 'icon' => 'fa-flag'],
                ],
            ],
        ];

        foreach ($additionalOpps as $oppData) {
            $steps = $oppData['steps'] ?? [];
            unset($oppData['steps']);

            $opp = FranchiseOpportunity::create($oppData);

            foreach ($steps as $i => $step) {
                FranchiseOpportunityStep::create([
                    'opportunity_id' => $opp->id,
                    'title'          => $step['title'],
                    'description'    => $step['desc'],
                    'icon'           => $step['icon'],
                    'sort_order'     => $i + 1,
                ]);
            }
        }
    }
}
