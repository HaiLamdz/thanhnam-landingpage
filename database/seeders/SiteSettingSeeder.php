<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'company_name'             => 'Thành Nam TFC.,JSC',
            'company_logo'             => '',
            'hero_headline'            => 'Giải Pháp Nền Móng Chuyên Nghiệp',
            'hero_description'         => 'Chuyên thi công cọc bê tông, ép cọc, khoan cắt bê tông và các giải pháp nền móng chuyên dụng. Hơn 10 năm kinh nghiệm, uy tín và chất lượng hàng đầu.',
            'hero_bg_image'            => '',
            'about_image'              => '',
            'about_text'               => 'Công ty Cổ phần Thương mại Xây dựng Nền móng Thành Nam (THANH NAM TFC.,JSC) được thành lập năm 2014, chuyên cung cấp các dịch vụ xây dựng nền móng chuyên dụng tại Hà Nội và các tỉnh lân cận.',
            'about_stat_label'         => 'Năm kinh nghiệm',
            'about_stat_value'         => '10+',
            'cta_heading'              => 'Xây Dựng Nền Móng Vững Chắc Cùng Chúng Tôi',
            'cta_description'          => 'Liên hệ ngay để được tư vấn giải pháp nền móng phù hợp nhất cho công trình của bạn.',
            'contact_address'          => 'Số nhà 12 hẻm 3 ngách 33 số 2 phố Văn Trì, Phường Minh Khai, Quận Bắc Từ Liêm, Thành phố Hà Nội',
            'contact_email'            => 'thanhnambmtfc@gmail.com',
            'contact_phone'            => '',
            'footer_description'       => 'Công ty Cổ phần Thương mại Xây dựng Nền móng Thành Nam — Chuyên ép cọc, khoan cắt bê tông, thi công cọc bê tông cốt thép, cọc dự ứng lực, cọc ly tâm.',
            'social_linkedin'          => '',
            'social_facebook'          => '',
            'social_youtube'           => '',
            'about_page_content'       => '<p>Công ty Cổ phần Thương mại Xây dựng Nền móng Thành Nam (THANH NAM TFC.,JSC) được thành lập ngày 30/09/2014.</p><p><strong>Ngành nghề chính:</strong> Khoan cắt bê tông, ép cọc, đóng cọc cừ larsen, thi công cọc bê tông cốt thép, cọc bê tông dự ứng lực, cọc ly tâm.</p><p><strong>Địa chỉ:</strong> Số nhà 12 hẻm 3 ngách 33 số 2 phố Văn Trì, Phường Minh Khai, Quận Bắc Từ Liêm, Thành phố Hà Nội.</p><p><strong>Mã số thuế:</strong> 0201574928</p>',
            'meta_description_default' => 'Thành Nam TFC.,JSC — Chuyên ép cọc, khoan cắt bê tông, thi công cọc bê tông cốt thép tại Hà Nội. MST: 0201574928.',
            'tax_code'                 => '0201574928',
            'google_maps_embed'        => '',
            'zalo_phone'               => '',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}
