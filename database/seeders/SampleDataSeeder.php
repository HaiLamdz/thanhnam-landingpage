<?php

namespace Database\Seeders;

use App\Models\NewsPost;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedServices();
        $this->seedNews();
        $this->seedProjects();
    }

    private function seedServices(): void
    {
        $services = [
            ['title' => 'Tư vấn chiến lược doanh nghiệp', 'summary' => 'Hỗ trợ doanh nghiệp xây dựng chiến lược phát triển bền vững và hiệu quả.', 'icon' => 'bi-lightbulb'],
            ['title' => 'Thiết kế & phát triển phần mềm', 'summary' => 'Xây dựng các giải pháp phần mềm tùy chỉnh đáp ứng nhu cầu đặc thù của từng doanh nghiệp.', 'icon' => 'bi-code-slash'],
            ['title' => 'Chuyển đổi số toàn diện', 'summary' => 'Đồng hành cùng doanh nghiệp trong hành trình chuyển đổi số từ quy trình đến hạ tầng công nghệ.', 'icon' => 'bi-arrow-repeat'],
            ['title' => 'Quản lý hạ tầng đám mây', 'summary' => 'Triển khai và vận hành hạ tầng đám mây an toàn, linh hoạt và tiết kiệm chi phí.', 'icon' => 'bi-cloud'],
            ['title' => 'Bảo mật thông tin & an ninh mạng', 'summary' => 'Bảo vệ dữ liệu và hệ thống của doanh nghiệp trước các mối đe dọa an ninh mạng hiện đại.', 'icon' => 'bi-shield-lock'],
            ['title' => 'Phân tích dữ liệu & Business Intelligence', 'summary' => 'Khai thác dữ liệu để đưa ra quyết định kinh doanh chính xác và kịp thời.', 'icon' => 'bi-bar-chart'],
            ['title' => 'Thiết kế UI/UX chuyên nghiệp', 'summary' => 'Tạo ra trải nghiệm người dùng trực quan, thẩm mỹ và tối ưu chuyển đổi.', 'icon' => 'bi-palette'],
            ['title' => 'Tích hợp hệ thống ERP', 'summary' => 'Kết nối và đồng bộ hóa các hệ thống quản lý doanh nghiệp để tối ưu vận hành.', 'icon' => 'bi-diagram-3'],
            ['title' => 'Đào tạo & nâng cao năng lực số', 'summary' => 'Chương trình đào tạo thực tiễn giúp đội ngũ doanh nghiệp làm chủ công nghệ mới.', 'icon' => 'bi-mortarboard'],
            ['title' => 'Hỗ trợ kỹ thuật & bảo trì hệ thống', 'summary' => 'Dịch vụ hỗ trợ kỹ thuật 24/7 đảm bảo hệ thống hoạt động ổn định và liên tục.', 'icon' => 'bi-tools'],
        ];

        foreach ($services as $i => $data) {
            Service::create([
                'title'      => $data['title'],
                'slug'       => Str::slug($data['title']) . '-' . ($i + 1),
                'summary'    => $data['summary'],
                'body'       => '<p>' . $data['summary'] . '</p><p>Chúng tôi cung cấp giải pháp toàn diện với đội ngũ chuyên gia giàu kinh nghiệm, cam kết mang lại giá trị thực sự cho doanh nghiệp của bạn.</p>',
                'icon'       => $data['icon'],
                'image_path' => null,
                'status'     => 'published',
                'sort_order' => $i + 1,
            ]);
        }
    }

    private function seedNews(): void
    {
        $news = [
            ['title' => 'Xu hướng chuyển đổi số doanh nghiệp năm 2025', 'category_tag' => 'Công nghệ', 'excerpt' => 'Những xu hướng công nghệ nổi bật đang định hình lại cách doanh nghiệp vận hành và cạnh tranh trong năm 2025.'],
            ['title' => 'Trí tuệ nhân tạo và tương lai của ngành sản xuất', 'category_tag' => 'AI & Tự động hóa', 'excerpt' => 'AI đang cách mạng hóa ngành sản xuất với khả năng tự động hóa quy trình và dự đoán bảo trì thiết bị.'],
            ['title' => 'Bảo mật dữ liệu trong kỷ nguyên đám mây', 'category_tag' => 'Bảo mật', 'excerpt' => 'Các chiến lược bảo mật hiệu quả giúp doanh nghiệp bảo vệ dữ liệu nhạy cảm khi chuyển lên môi trường đám mây.'],
            ['title' => 'Hành trình số hóa của doanh nghiệp vừa và nhỏ', 'category_tag' => 'Chuyển đổi số', 'excerpt' => 'Câu chuyện thành công của các SME Việt Nam trong việc ứng dụng công nghệ để tăng trưởng bền vững.'],
            ['title' => 'Phân tích dữ liệu lớn: Từ lý thuyết đến thực tiễn', 'category_tag' => 'Dữ liệu', 'excerpt' => 'Hướng dẫn thực tế giúp doanh nghiệp bắt đầu hành trình khai thác Big Data để tạo lợi thế cạnh tranh.'],
            ['title' => 'Điện toán đám mây hybrid: Giải pháp linh hoạt cho doanh nghiệp', 'category_tag' => 'Đám mây', 'excerpt' => 'Mô hình hybrid cloud kết hợp ưu điểm của đám mây công cộng và riêng tư, phù hợp với nhiều loại hình doanh nghiệp.'],
            ['title' => 'Tự động hóa quy trình với RPA: Tiết kiệm chi phí vận hành', 'category_tag' => 'AI & Tự động hóa', 'excerpt' => 'Robotic Process Automation giúp doanh nghiệp giảm thiểu công việc thủ công và tối ưu hóa nguồn lực nhân sự.'],
            ['title' => 'Thiết kế trải nghiệm người dùng trong thời đại di động', 'category_tag' => 'Thiết kế', 'excerpt' => 'Nguyên tắc thiết kế UX hiện đại giúp ứng dụng di động tạo ra trải nghiệm mượt mà và tăng tỷ lệ giữ chân người dùng.'],
            ['title' => 'Blockchain và ứng dụng trong chuỗi cung ứng', 'category_tag' => 'Công nghệ', 'excerpt' => 'Công nghệ blockchain đang tạo ra sự minh bạch và tin cậy trong quản lý chuỗi cung ứng toàn cầu.'],
            ['title' => 'Chiến lược xây dựng đội ngũ IT nội bộ hiệu quả', 'category_tag' => 'Quản trị', 'excerpt' => 'Bí quyết tuyển dụng, đào tạo và giữ chân nhân tài công nghệ trong bối cảnh cạnh tranh nhân lực gay gắt.'],
        ];

        foreach ($news as $i => $data) {
            $slug = Str::slug($data['title']) . '-' . ($i + 1);
            NewsPost::create([
                'title'               => $data['title'],
                'slug'                => $slug,
                'excerpt'             => $data['excerpt'],
                'body'                => '<p>' . $data['excerpt'] . '</p><p>Trong bối cảnh công nghệ phát triển không ngừng, doanh nghiệp cần chủ động nắm bắt xu hướng và thích ứng linh hoạt để duy trì lợi thế cạnh tranh trên thị trường.</p><p>Hãy liên hệ với chúng tôi để được tư vấn giải pháp phù hợp nhất với nhu cầu của doanh nghiệp bạn.</p>',
                'category_tag'        => $data['category_tag'],
                'featured_image_path' => null,
                'status'              => 'published',
                'published_at'        => now()->subDays(rand(1, 90)),
            ]);
        }
    }

    private function seedProjects(): void
    {
        $projects = [
            ['title' => 'Hệ thống quản lý bán hàng đa kênh cho TechMart', 'description' => 'Xây dựng nền tảng thương mại điện tử tích hợp quản lý kho, đơn hàng và khách hàng cho chuỗi bán lẻ 50+ cửa hàng.'],
            ['title' => 'Chuyển đổi số toàn diện cho Tập đoàn Xây dựng Phú Hưng', 'description' => 'Triển khai ERP và hệ thống quản lý dự án xây dựng, giúp tối ưu hóa quy trình từ thiết kế đến thi công và nghiệm thu.'],
            ['title' => 'Ứng dụng di động chăm sóc sức khỏe MediCare+', 'description' => 'Phát triển ứng dụng kết nối bệnh nhân với bác sĩ, tích hợp đặt lịch khám, tư vấn trực tuyến và quản lý hồ sơ y tế.'],
            ['title' => 'Nền tảng học trực tuyến EduViet cho Bộ Giáo dục', 'description' => 'Xây dựng hệ thống LMS phục vụ hơn 500.000 học sinh với tính năng học tương tác, kiểm tra trực tuyến và theo dõi tiến độ.'],
            ['title' => 'Hệ thống ngân hàng lõi cho VietFinance Bank', 'description' => 'Nâng cấp core banking system, tích hợp thanh toán số và triển khai ứng dụng mobile banking thế hệ mới.'],
            ['title' => 'Giải pháp IoT quản lý nhà máy thông minh cho VinFactory', 'description' => 'Lắp đặt hệ thống cảm biến và phần mềm giám sát thời gian thực, giúp giảm 30% chi phí vận hành và bảo trì.'],
            ['title' => 'Cổng thông tin điện tử tỉnh Bình Dương', 'description' => 'Xây dựng cổng dịch vụ công trực tuyến tích hợp 200+ dịch vụ hành chính, phục vụ hơn 2 triệu người dân.'],
            ['title' => 'Hệ thống CRM & Marketing Automation cho FashionHub', 'description' => 'Triển khai giải pháp quản lý quan hệ khách hàng và tự động hóa chiến dịch marketing, tăng 45% tỷ lệ chuyển đổi.'],
            ['title' => 'Nền tảng logistics thông minh cho GreenShip', 'description' => 'Phát triển hệ thống tối ưu hóa tuyến đường, quản lý đội xe và theo dõi đơn hàng thời gian thực cho công ty vận tải.'],
            ['title' => 'Hệ thống quản lý năng lượng tòa nhà thông minh SkyTower', 'description' => 'Tích hợp BMS và AI để tối ưu tiêu thụ điện năng, giảm 25% chi phí năng lượng cho tòa nhà văn phòng 40 tầng.'],
        ];

        foreach ($projects as $i => $data) {
            Project::create([
                'title'       => $data['title'],
                'description' => $data['description'],
                'image_path'  => null,
                'status'      => 'published',
            ]);
        }
    }
}
