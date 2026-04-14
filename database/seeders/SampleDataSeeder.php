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
            [
                'title'   => 'Thi công ép cọc bê tông cốt thép',
                'summary' => 'Sản xuất và thi công ép cọc bê tông cốt thép các kích thước 200×200, 250×250, 300×300, 400×400 mm. Đảm bảo nền móng vững chắc cho mọi loại công trình.',
                'icon'    => 'bi-hammer',
            ],
            [
                'title'   => 'Thi công ép cọc bê tông ly tâm dự ứng lực',
                'summary' => 'Sản xuất và thi công ép cọc bê tông ly tâm dự ứng lực D300, D400, D500, D600 mm. Phù hợp cho các công trình quy mô lớn, tải trọng cao.',
                'icon'    => 'bi-gear',
            ],
            [
                'title'   => 'Cho thuê máy ép cọc & khoan cọc nhồi',
                'summary' => 'Cho thuê máy khoan cọc nhồi và Robot thi công ép cọc từ 100 đến 680 tấn. Thiết bị hiện đại, đội ngũ vận hành chuyên nghiệp.',
                'icon'    => 'bi-truck',
            ],
            [
                'title'   => 'Thí nghiệm sức chịu tải cọc',
                'summary' => 'Thí nghiệm sức chịu tải cọc bê tông cốt thép, bê tông dự ứng lực, khoan nhồi bằng phương pháp ép tĩnh dọc trục, PDA, PIT, siêu âm.',
                'icon'    => 'bi-clipboard-data',
            ],
            [
                'title'   => 'Khảo sát địa chất công trình',
                'summary' => 'Khoan khảo sát địa chất công trình, kiểm tra nền đất bằng phương pháp xác định Modun biến dạng tấm nén phẳng. Cung cấp số liệu địa chất chính xác.',
                'icon'    => 'bi-search',
            ],
            [
                'title'   => 'Thí nghiệm vật liệu xây dựng',
                'summary' => 'Thí nghiệm vật liệu xây dựng dân dụng và chuyên ngành cầu đường tại phòng thí nghiệm và ngoài hiện trường. Được Bộ Xây dựng cấp phép LAXD 1780.',
                'icon'    => 'bi-flask',
            ],
            [
                'title'   => 'Xây dựng công trình dân dụng',
                'summary' => 'Xây dựng các công trình nhà văn hóa, trường học, thủy lợi và hạ tầng kỹ thuật. Thi công chuyên nghiệp, đảm bảo tiến độ và chất lượng.',
                'icon'    => 'bi-building',
            ],
            [
                'title'   => 'Kiểm tra & kiểm định kết cấu công trình',
                'summary' => 'Kiểm tra chất lượng kết cấu bê tông cốt thép bằng súng bật nẩy, siêu âm bê tông, kiểm tra mối hàn và chiều dày lớp bảo vệ cốt thép.',
                'icon'    => 'bi-shield-check',
            ],
        ];

        foreach ($services as $i => $data) {
            Service::create([
                'title'      => $data['title'],
                'slug'       => Str::slug($data['title']) . '-' . ($i + 1),
                'summary'    => $data['summary'],
                'body'       => '<p>' . $data['summary'] . '</p><p>Với đội ngũ kỹ sư chuyên ngành và thiết bị hiện đại, Thành Nam TFC cam kết thực hiện dịch vụ đạt tiêu chuẩn kỹ thuật cao nhất, đúng tiến độ và giá cả cạnh tranh.</p>',
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
            ['title' => 'Xu hướng thi công nền móng hiện đại năm 2025', 'category_tag' => 'Kỹ thuật', 'excerpt' => 'Những công nghệ và phương pháp thi công nền móng tiên tiến đang được áp dụng rộng rãi trong ngành xây dựng Việt Nam năm 2025.'],
            ['title' => 'Phương pháp thí nghiệm PDA trong kiểm tra chất lượng cọc', 'category_tag' => 'Kỹ thuật', 'excerpt' => 'Thí nghiệm biến dạng lớn PDA (Pile Driving Analyzer) là phương pháp hiện đại giúp đánh giá sức chịu tải và chất lượng cọc nhanh chóng, chính xác.'],
            ['title' => 'Tiêu chuẩn TCVN trong thi công ép cọc bê tông', 'category_tag' => 'Tiêu chuẩn', 'excerpt' => 'Tổng hợp các tiêu chuẩn Việt Nam áp dụng trong thi công ép cọc bê tông cốt thép và bê tông dự ứng lực, đảm bảo chất lượng công trình.'],
            ['title' => 'Khảo sát địa chất — bước quan trọng trước khi thi công', 'category_tag' => 'Tư vấn', 'excerpt' => 'Khảo sát địa chất công trình là bước không thể bỏ qua, giúp lựa chọn giải pháp nền móng phù hợp và tránh rủi ro trong quá trình thi công.'],
            ['title' => 'Cọc bê tông ly tâm dự ứng lực — ưu điểm và ứng dụng', 'category_tag' => 'Vật liệu', 'excerpt' => 'Cọc bê tông ly tâm dự ứng lực ngày càng được ưa chuộng nhờ khả năng chịu tải cao, thi công nhanh và độ bền vượt trội so với cọc truyền thống.'],
            ['title' => 'Thí nghiệm nén tĩnh cọc — quy trình và ý nghĩa', 'category_tag' => 'Kỹ thuật', 'excerpt' => 'Thí nghiệm nén tĩnh cọc là phương pháp trực tiếp và đáng tin cậy nhất để xác định sức chịu tải thực tế của cọc trong điều kiện địa chất thực tế.'],
        ];

        foreach ($news as $i => $data) {
            $slug = Str::slug($data['title']) . '-' . ($i + 1);
            NewsPost::create([
                'title'               => $data['title'],
                'slug'                => $slug,
                'excerpt'             => $data['excerpt'],
                'body'                => '<p>' . $data['excerpt'] . '</p><p>Công ty Thành Nam TFC với đội ngũ kỹ sư chuyên ngành và thiết bị hiện đại luôn sẵn sàng tư vấn và hỗ trợ khách hàng lựa chọn giải pháp kỹ thuật tối ưu nhất.</p><p>Liên hệ với chúng tôi qua hotline 0972.428.939 hoặc email Thanhnam.tfc@gmail.com để được tư vấn miễn phí.</p>',
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
            [
                'title'       => 'Dự án đầu tư xây dựng cơ sở hạ tầng Viettel',
                'description' => 'Thi công ép cọc bê tông cho dự án đầu tư xây dựng cơ sở hạ tầng Viettel tại Khu công nghệ cao Hòa Lạc, Thạch Thất, Hà Nội. Chủ đầu tư: Công ty quản lý tài sản Viettel — Chi nhánh Tập đoàn Công nghiệp Viễn thông Quân Đội.',
                'client'      => 'Công ty quản lý tài sản Viettel — Chi nhánh Tập đoàn Công nghiệp Viễn thông Quân Đội',
                'location'    => 'Khu công nghệ cao Hòa Lạc, Thạch Thất, Hà Nội',
            ],
            [
                'title'       => 'Khu nhà ở xã hội phường Đồng Văn, Duy Tiên, Hà Nam — Tòa A',
                'description' => 'Thi công ép cọc bê tông cho dự án đầu tư xây dựng Khu nhà ở xã hội tại phường Đồng Văn, Thị xã Duy Tiên, Tỉnh Hà Nam — Tòa A. Chủ đầu tư: Tổng công ty Đầu tư Phát triển Nhà Đô thị — Công ty TNHH.',
                'client'      => 'Tổng công ty Đầu tư Phát triển Nhà Đô thị — Công ty TNHH',
                'location'    => 'Phường Đồng Văn, Thị xã Duy Tiên, Tỉnh Hà Nam',
            ],
            [
                'title'       => 'Khu nhà ở xã hội Tổng Kho 3 Lạc Viên, Q. Ngô Quyền, Hải Phòng',
                'description' => 'Thi công ép cọc bê tông cho khu nhà ở xã hội tại Tổng Kho 3 Lạc Viên (Số 142 Lê Lai), phường Máy Chai và phường Cầu Tre, Quận Ngô Quyền, TP. Hải Phòng. Chủ đầu tư: Công ty Cổ phần Thái-Holding.',
                'client'      => 'Công ty Cổ phần Thái-Holding',
                'location'    => 'Số 142 Lê Lai, phường Máy Chai và phường Cầu Tre, Q. Ngô Quyền, TP. Hải Phòng',
            ],
            [
                'title'       => 'Xây dựng Trường THCS Khương Thượng, Quận Đống Đa',
                'description' => 'Thi công ép cọc bê tông cho công trình xây dựng Trường THCS Khương Thượng tại số 10 Tôn Thất Tùng, Phường Trung Tự, Quận Đống Đa, TP. Hà Nội. Chủ đầu tư: Ban quản lý dự án đầu tư xây dựng Quận Đống Đa.',
                'client'      => 'Ban quản lý dự án đầu tư xây dựng Quận Đống Đa',
                'location'    => 'Số 10 Tôn Thất Tùng, Phường Trung Tự, Quận Đống Đa, TP. Hà Nội',
            ],
            [
                'title'       => 'Khu nhà ở xã hội phường Đồng Văn, Duy Tiên, Hà Nam — Tòa B',
                'description' => 'Thi công ép cọc bê tông cho dự án đầu tư xây dựng Khu nhà ở xã hội tại phường Đồng Văn, Thị xã Duy Tiên, Tỉnh Hà Nam — Tòa B. Chủ đầu tư: Tổng công ty Đầu tư Phát triển Nhà Đô thị.',
                'client'      => 'Tổng công ty Đầu tư Phát triển Nhà Đô thị',
                'location'    => 'Phường Đồng Văn, Thị xã Duy Tiên, Tỉnh Hà Nam',
            ],
            [
                'title'       => 'Trường Tiểu học Vân Côn — Khoan địa chất & Thí nghiệm nén tĩnh cọc',
                'description' => 'Khoan khảo sát địa chất công trình và thí nghiệm nén tĩnh cọc cho dự án đầu tư xây dựng trường Tiểu học Vân Côn, huyện Hoài Đức, TP. Hà Nội. Chủ đầu tư: Ban quản lý dự án huyện Hoài Đức.',
                'client'      => 'Ban quản lý dự án huyện Hoài Đức',
                'location'    => 'Xã Vân Côn, Huyện Hoài Đức, TP. Hà Nội',
            ],
            [
                'title'       => 'Công trình ngầm & cầu dân sinh Huyện Lục Nam, Bắc Giang',
                'description' => 'Đầu tư xây dựng công trình ngầm, cầu dân sinh trên địa bàn vùng đồng bào dân tộc thiểu số và miền núi Huyện Lục Nam, Tỉnh Bắc Giang. Chủ đầu tư: Ban quản lý dự án huyện Lục Nam.',
                'client'      => 'Ban quản lý dự án huyện Lục Nam',
                'location'    => 'Huyện Lục Nam, Tỉnh Bắc Giang',
            ],
            [
                'title'       => 'Nhà máy Regina Miracle International (Viet Nam) — Period Of 4',
                'description' => 'Cung cấp và ép cọc bê tông cho Nhà máy Regina Miracle International (Viet Nam) Co., Ltd (Period Of 4) tại Khu Công nghiệp VSIP Hải Phòng.',
                'client'      => 'Công ty Regina Miracle International (Viet Nam)',
                'location'    => 'Khu CN VSIP Hải Phòng, TP. Hải Phòng',
            ],
            [
                'title'       => 'Đầu tư xây dựng nhà ở gia đình tại KĐT Phương Canh, Hoài Đức',
                'description' => 'Thi công ép cọc và xây dựng nhà để ở cho gia đình tại Khu đô thị Phương Canh, Hoài Đức, Hà Nội.',
                'client'      => 'Gia đình tư nhân',
                'location'    => 'KĐT Phương Canh, Hoài Đức, Hà Nội',
            ],
            [
                'title'       => 'Khu đô thị Kim Trung Di Trạch — Lô BT16',
                'description' => 'Thi công ép cọc bê tông cho Lô BT16 tại Khu đô thị Kim Trung Di Trạch, Hoài Đức, Hà Nội. Chủ đầu tư: Công ty Cổ phần SamCo.',
                'client'      => 'Công ty Cổ phần SamCo',
                'location'    => 'KĐT Kim Trung Di Trạch, Hoài Đức, Hà Nội',
            ],
            [
                'title'       => 'Hạ tầng kỹ thuật nông nghiệp xã Dương Quang, Gia Lâm',
                'description' => 'Xây dựng hạ tầng kỹ thuật phục vụ sản xuất nông nghiệp các thôn Quang Trung, Đề Trụ 7, xã Dương Quang, huyện Gia Lâm, TP. Hà Nội. Chủ đầu tư: Trung tâm Phát triển Quỹ đất huyện Gia Lâm.',
                'client'      => 'Trung tâm Phát triển Quỹ đất huyện Gia Lâm',
                'location'    => 'Thôn Quang Trung, Đề Trụ 7, xã Dương Quang, Huyện Gia Lâm, TP. Hà Nội',
            ],
            [
                'title'       => 'Thi công phần ngầm Tòa CT1 — KĐT Kim Trung Di Trạch',
                'description' => 'Thi công phần ngầm Tòa CT1 tại Khu đô thị Kim Trung Di Trạch, Hoài Đức, Hà Nội. Chủ đầu tư: Tổng công ty Cổ phần Thương mại Xây dựng.',
                'client'      => 'Tổng công ty Cổ phần Thương mại Xây dựng',
                'location'    => 'KĐT Kim Trung Di Trạch, Hoài Đức, Hà Nội',
            ],
            [
                'title'       => 'Kiểm tra chất lượng cọc Nhà máy Thanh Sơn Hà Nam',
                'description' => 'Kiểm tra chất lượng cọc bê tông cho Nhà máy Thanh Sơn Hà Nam tại KCN Kiện Khê, Hà Nam. Chủ đầu tư: Công ty TNHH Thanh Sơn Hà Nam.',
                'client'      => 'Công ty TNHH Thanh Sơn Hà Nam',
                'location'    => 'KCN Kiện Khê, Hà Nam',
            ],
            [
                'title'       => 'Cải tạo nhà đa năng, nhà điều hành & hạ tầng kỹ thuật Nhà máy Z199',
                'description' => 'Đầu tư xây dựng, cải tạo nhà đa năng, nhà điều hành, nhà xưởng và hạ tầng kỹ thuật cho Nhà máy Z199 tại tổ 2 phường Phú Diễn, quận Bắc Từ Liêm, TP. Hà Nội.',
                'client'      => 'Nhà máy Z199',
                'location'    => 'Tổ 2 phường Phú Diễn, Quận Bắc Từ Liêm, TP. Hà Nội',
            ],
        ];

        foreach ($projects as $i => $data) {
            Project::create([
                'title'       => $data['title'],
                'description' => $data['description'],
                'client'      => $data['client'],
                'location'    => $data['location'],
                'image_path'  => null,
                'status'      => 'published',
            ]);
        }
    }
}
