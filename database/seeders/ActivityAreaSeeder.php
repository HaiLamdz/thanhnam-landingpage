<?php

namespace Database\Seeders;

use App\Models\ActivityArea;
use Illuminate\Database\Seeder;

class ActivityAreaSeeder extends Seeder
{
    public function run(): void
    {
        $areas = [
            [
                'title' => 'Thi công ép cọc bê tông',
                'description' => 'Thi công nền móng công trình các loại. Sản xuất và thi công ép cọc bê tông cốt thép (200×200, 250×250, 300×300, 400×400 mm). Sản xuất và thi công ép cọc bê tông ly tâm dự ứng lực (D300, D400, D500, D600 mm). Cho thuê máy khoan cọc nhồi và Robot thi công ép cọc từ 100 đến 680 tấn.',
                'icon' => 'bi-hammer',
            ],
            [
                'title' => 'Kiểm tra & tư vấn nền móng công trình',
                'description' => 'Thí nghiệm sức chịu tải cọc bằng phương pháp ép tĩnh dọc trục, nhổ dọc trục, đẩy ngang, siêu âm, PDA, PIT. Kiểm tra nền đất bằng phương pháp xác định Modun biến dạng tấm nén phẳng. Khoan khảo sát địa chất công trình.',
                'icon' => 'bi-search',
            ],
            [
                'title' => 'Xây dựng công trình',
                'description' => 'Cung cấp và ép các loại cọc bê tông cốt thép, bê tông dự ứng lực. Xây dựng các công trình nhà văn hóa, trường học, thủy lợi và hạ tầng kỹ thuật.',
                'icon' => 'bi-building',
            ],
            [
                'title' => 'Thí nghiệm vật liệu xây dựng',
                'description' => 'Thí nghiệm vật liệu xây dựng dân dụng tại phòng thí nghiệm và ngoài hiện trường. Thí nghiệm vật liệu chuyên ngành cầu đường. Được Bộ Xây dựng cấp phép hoạt động thí nghiệm chuyên ngành xây dựng LAXD 1780 (cấp ngày 25/06/2021).',
                'icon' => 'bi-clipboard-data',
            ],
        ];

        foreach ($areas as $index => $data) {
            ActivityArea::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'icon' => $data['icon'],
                'sort_order' => $index + 1,
                'status' => 'published',
            ]);
        }
    }
}
