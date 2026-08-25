<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Business\Specialty;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = [

            // =========================================================
            // مكاتب المحاماة
            // =========================================================
            [
                'office_type' => 'law',
                'name_ar' => 'القضايا التجارية',
                'name_en' => 'Commercial Law',
            ],
            [
                'office_type' => 'law',
                'name_ar' => 'القضايا الجنائية',
                'name_en' => 'Criminal Law',
            ],
            [
                'office_type' => 'law',
                'name_ar' => 'القضايا المدنية',
                'name_en' => 'Civil Law',
            ],
            [
                'office_type' => 'law',
                'name_ar' => 'قضايا الأحوال الشخصية',
                'name_en' => 'Personal Status Law',
            ],
            [
                'office_type' => 'law',
                'name_ar' => 'القضايا العمالية',
                'name_en' => 'Labor Law',
            ],
            [
                'office_type' => 'law',
                'name_ar' => 'القضايا الإدارية',
                'name_en' => 'Administrative Law',
            ],
            [
                'office_type' => 'law',
                'name_ar' => 'الاستشارات القانونية',
                'name_en' => 'Legal Consultation',
            ],
            [
                'office_type' => 'law',
                'name_ar' => 'صياغة العقود',
                'name_en' => 'Contract Drafting',
            ],

            // =========================================================
            // مكاتب الخدمات
            // =========================================================
            [
                'office_type' => 'services',
                'name_ar' => 'الخدمات الحكومية',
                'name_en' => 'Government Services',
            ],
            [
                'office_type' => 'services',
                'name_ar' => 'خدمات التعقيب',
                'name_en' => 'Government Transactions',
            ],
            [
                'office_type' => 'services',
                'name_ar' => 'خدمات التوثيق',
                'name_en' => 'Documentation Services',
            ],
            [
                'office_type' => 'services',
                'name_ar' => 'خدمات تأسيس الشركات',
                'name_en' => 'Business Establishment Services',
            ],

            // =========================================================
            // مكاتب التخليص الجمركي
            // =========================================================
            [
                'office_type' => 'customs',
                'name_ar' => 'التخليص الجمركي',
                'name_en' => 'Customs Clearance',
            ],
            [
                'office_type' => 'customs',
                'name_ar' => 'الاستيراد والتصدير',
                'name_en' => 'Import & Export',
            ],
            [
                'office_type' => 'customs',
                'name_ar' => 'الاستشارات الجمركية',
                'name_en' => 'Customs Consulting',
            ],
            [
                'office_type' => 'customs',
                'name_ar' => 'إنهاء الإجراءات الجمركية',
                'name_en' => 'Customs Procedures',
            ],

            // =========================================================
            // مكاتب المحاسبة
            // =========================================================
            [
                'office_type' => 'accounting',
                'name_ar' => 'المحاسبة المالية',
                'name_en' => 'Financial Accounting',
            ],
            [
                'office_type' => 'accounting',
                'name_ar' => 'مراجعة الحسابات',
                'name_en' => 'Auditing',
            ],
            [
                'office_type' => 'accounting',
                'name_ar' => 'الزكاة والضرائب',
                'name_en' => 'Zakat & Tax',
            ],
            [
                'office_type' => 'accounting',
                'name_ar' => 'إعداد القوائم المالية',
                'name_en' => 'Financial Statements',
            ],
            [
                'office_type' => 'accounting',
                'name_ar' => 'المحاسبة الإدارية',
                'name_en' => 'Management Accounting',
            ],

            // =========================================================
            // المكاتب الهندسية
            // =========================================================
            [
                'office_type' => 'engineering',
                'name_ar' => 'الهندسة المعمارية',
                'name_en' => 'Architecture',
            ],
            [
                'office_type' => 'engineering',
                'name_ar' => 'الهندسة المدنية',
                'name_en' => 'Civil Engineering',
            ],
            [
                'office_type' => 'engineering',
                'name_ar' => 'الهندسة الكهربائية',
                'name_en' => 'Electrical Engineering',
            ],
            [
                'office_type' => 'engineering',
                'name_ar' => 'الهندسة الميكانيكية',
                'name_en' => 'Mechanical Engineering',
            ],
            [
                'office_type' => 'engineering',
                'name_ar' => 'هندسة المشاريع',
                'name_en' => 'Project Engineering',
            ],
            [
                'office_type' => 'engineering',
                'name_ar' => 'التصميم الهندسي',
                'name_en' => 'Engineering Design',
            ],

            // =========================================================
            // العمل الحر
            // =========================================================
            [
                'office_type' => 'freelance',
                'name_ar' => 'البرمجة وتطوير المواقع',
                'name_en' => 'Programming & Web Development',
            ],
            [
                'office_type' => 'freelance',
                'name_ar' => 'التصميم الجرافيكي',
                'name_en' => 'Graphic Design',
            ],
            [
                'office_type' => 'freelance',
                'name_ar' => 'التسويق الرقمي',
                'name_en' => 'Digital Marketing',
            ],
            [
                'office_type' => 'freelance',
                'name_ar' => 'الترجمة',
                'name_en' => 'Translation',
            ],
            [
                'office_type' => 'freelance',
                'name_ar' => 'كتابة المحتوى',
                'name_en' => 'Content Writing',
            ],
        ];

        foreach ($specialties as $specialty) {

            Specialty::updateOrCreate(
                [
                    'office_type' => $specialty['office_type'],
                    'name_ar' => $specialty['name_ar'],
                ],
                [
                    'name_en' => $specialty['name_en'],
                    'is_active' => true,
                ]
            );
        }
    }
}