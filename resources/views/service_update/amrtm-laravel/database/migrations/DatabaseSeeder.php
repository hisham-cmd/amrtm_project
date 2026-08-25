<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Entity;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin user ──
        User::create([
            'name'     => 'مدير النظام',
            'email'    => 'admin@amrtm.com.sa',
            'password' => Hash::make('Admin@2025'),
            'role'     => 'admin',
            'balance'  => 0,
        ]);

        // ── Test user ──
        User::create([
            'name'     => 'مستخدم تجريبي',
            'email'    => 'user@amrtm.com.sa',
            'phone'    => '0500000000',
            'password' => Hash::make('User@2025'),
            'role'     => 'user',
            'balance'  => 500,
        ]);

        // ── Categories ──
        $ministries = Category::create([
            'key'      => 'ministries',
            'name_ar'  => 'الوزارات',
            'name_en'  => 'Ministries',
            'icon'     => 'ti-building-bank',
            'color'    => '#1A237E',
            'bg'       => 'rgba(26,35,126,.1)',
            'sort_order' => 1,
        ]);

        $authorities = Category::create([
            'key'      => 'authorities',
            'name_ar'  => 'الهيئات',
            'name_en'  => 'Authorities',
            'icon'     => 'ti-award',
            'color'    => '#6A1B9A',
            'bg'       => 'rgba(106,27,154,.1)',
            'sort_order' => 2,
        ]);

        $companies = Category::create([
            'key'      => 'companies',
            'name_ar'  => 'الشركات الحكومية',
            'name_en'  => 'Government Companies',
            'icon'     => 'ti-building-factory',
            'color'    => '#1B5E20',
            'bg'       => 'rgba(27,94,32,.1)',
            'sort_order' => 3,
        ]);

        $embassies = Category::create([
            'key'      => 'embassies',
            'name_ar'  => 'السفارات والقنصليات',
            'name_en'  => 'Embassies & Consulates',
            'icon'     => 'ti-world',
            'color'    => '#00838F',
            'bg'       => 'rgba(0,131,143,.1)',
            'sort_order' => 4,
        ]);

        // ── Entities & Services — Ministries ──
        $interior = Entity::create([
            'category_id' => $ministries->id,
            'name_ar'     => 'وزارة الداخلية',
            'name_en'     => 'Ministry of Interior',
            'icon'        => 'ti-shield',
            'color'       => '#C62828',
            'bg'          => 'rgba(198,40,40,.11)',
            'tag_ar'      => 'الأمن والمواطنة',
            'tag_en'      => 'Security & Citizenship',
            'sort_order'  => 1,
        ]);

        Service::insert([
            ['entity_id'=>$interior->id,'name_ar'=>'استخراج جواز السفر','name_en'=>'Passport Issuance','icon'=>'ti-passport','price'=>350,'estimated_days'=>5,'sort_order'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['entity_id'=>$interior->id,'name_ar'=>'تجديد بطاقة الهوية','name_en'=>'ID Renewal','icon'=>'ti-id','price'=>150,'estimated_days'=>3,'sort_order'=>2,'created_at'=>now(),'updated_at'=>now()],
            ['entity_id'=>$interior->id,'name_ar'=>'تصاريح الإقامة','name_en'=>'Residency Permits','icon'=>'ti-home-check','price'=>500,'estimated_days'=>7,'sort_order'=>3,'created_at'=>now(),'updated_at'=>now()],
            ['entity_id'=>$interior->id,'name_ar'=>'خدمات المرور','name_en'=>'Traffic Services','icon'=>'ti-car','price'=>200,'estimated_days'=>2,'sort_order'=>4,'created_at'=>now(),'updated_at'=>now()],
            ['entity_id'=>$interior->id,'name_ar'=>'الأحوال المدنية','name_en'=>'Civil Status','icon'=>'ti-users','price'=>100,'estimated_days'=>3,'sort_order'=>5,'created_at'=>now(),'updated_at'=>now()],
        ]);

        $commerce = Entity::create([
            'category_id' => $ministries->id,
            'name_ar'     => 'وزارة التجارة',
            'name_en'     => 'Ministry of Commerce',
            'icon'        => 'ti-shopping-cart',
            'color'       => '#AD1457',
            'bg'          => 'rgba(173,20,87,.11)',
            'tag_ar'      => 'التجارة والأعمال',
            'tag_en'      => 'Trade & Business',
            'sort_order'  => 2,
        ]);

        Service::insert([
            ['entity_id'=>$commerce->id,'name_ar'=>'تسجيل شركة جديدة','name_en'=>'Company Registration','icon'=>'ti-building','price'=>1200,'estimated_days'=>10,'sort_order'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['entity_id'=>$commerce->id,'name_ar'=>'استخراج سجل تجاري','name_en'=>'Commercial Register','icon'=>'ti-file-text','price'=>300,'estimated_days'=>5,'sort_order'=>2,'created_at'=>now(),'updated_at'=>now()],
            ['entity_id'=>$commerce->id,'name_ar'=>'تجديد السجل التجاري','name_en'=>'CR Renewal','icon'=>'ti-refresh','price'=>250,'estimated_days'=>3,'sort_order'=>3,'created_at'=>now(),'updated_at'=>now()],
        ]);

        // ── Authorities ──
        $zatca = Entity::create([
            'category_id' => $authorities->id,
            'name_ar'     => 'هيئة الزكاة والضرائب والجمارك',
            'name_en'     => 'ZATCA',
            'icon'        => 'ti-receipt-tax',
            'color'       => '#6A1B9A',
            'bg'          => 'rgba(106,27,154,.1)',
            'tag_ar'      => 'الضرائب والجمارك',
            'tag_en'      => 'Tax & Customs',
            'sort_order'  => 1,
        ]);

        Service::insert([
            ['entity_id'=>$zatca->id,'name_ar'=>'التسجيل الضريبي','name_en'=>'Tax Registration','icon'=>'ti-file-text','price'=>500,'estimated_days'=>7,'sort_order'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['entity_id'=>$zatca->id,'name_ar'=>'إقرارات ضريبة القيمة المضافة','name_en'=>'VAT Returns','icon'=>'ti-calculator','price'=>350,'estimated_days'=>5,'sort_order'=>2,'created_at'=>now(),'updated_at'=>now()],
        ]);

        // ── Companies ──
        $gosi = Entity::create([
            'category_id' => $companies->id,
            'name_ar'     => 'المؤسسة العامة للتأمينات الاجتماعية',
            'name_en'     => 'GOSI',
            'icon'        => 'ti-shield-check',
            'color'       => '#1B5E20',
            'bg'          => 'rgba(27,94,32,.1)',
            'tag_ar'      => 'التأمينات الاجتماعية',
            'tag_en'      => 'Social Insurance',
            'sort_order'  => 1,
        ]);

        Service::insert([
            ['entity_id'=>$gosi->id,'name_ar'=>'التسجيل في التأمينات','name_en'=>'Social Insurance Registration','icon'=>'ti-file-text','price'=>200,'estimated_days'=>3,'sort_order'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['entity_id'=>$gosi->id,'name_ar'=>'طلب معاش التقاعد','name_en'=>'Pension Application','icon'=>'ti-coin','price'=>100,'estimated_days'=>14,'sort_order'=>2,'created_at'=>now(),'updated_at'=>now()],
        ]);

        // ── Embassies ──
        $usEmbassy = Entity::create([
            'category_id' => $embassies->id,
            'name_ar'     => 'السفارة السعودية في الولايات المتحدة',
            'name_en'     => 'Saudi Embassy - United States',
            'icon'        => 'ti-world',
            'color'       => '#00838F',
            'bg'          => 'rgba(0,131,143,.1)',
            'sort_order'  => 1,
        ]);

        Service::insert([
            ['entity_id'=>$usEmbassy->id,'name_ar'=>'تصديق الوثائق','name_en'=>'Document Attestation','icon'=>'ti-file-check','price'=>250,'estimated_days'=>3,'sort_order'=>1,'created_at'=>now(),'updated_at'=>now()],
            ['entity_id'=>$usEmbassy->id,'name_ar'=>'خدمات التأشيرة','name_en'=>'Visa Services','icon'=>'ti-ticket','price'=>400,'estimated_days'=>7,'sort_order'=>2,'created_at'=>now(),'updated_at'=>now()],
        ]);

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('Admin: admin@amrtm.com.sa / Admin@2025');
        $this->command->info('User:  user@amrtm.com.sa  / User@2025');
    }
}
