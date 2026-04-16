<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name'=>'Máy robot ép cọc (sản xuất tại Trung Quốc)',          'category'=>'Thiết bị nền móng', 'power'=>'320, 420, 680 tấn', 'qty'=>'15', 'quality'=>'92%'],
            ['name'=>'Kích thủy lực KN1000 (sản xuất tại Mỹ)',              'category'=>'Thiết bị nền móng', 'power'=>'1.000 tấn',         'qty'=>'02', 'quality'=>'97%'],
            ['name'=>'Cẩu Kato (sản xuất tại Nhật)',                        'category'=>'Thiết bị nền móng', 'power'=>'25 tấn',            'qty'=>'01', 'quality'=>'85%'],
            ['name'=>'Máy khoan địa chất XY-1, XY1A-4',                    'category'=>'Thiết bị nền móng', 'power'=>'—',                 'qty'=>'05', 'quality'=>'90%'],
            ['name'=>'Kích thủy lực KN800, 500, 300, 200, 100 (TQ, VN)',   'category'=>'Thiết bị nền móng', 'power'=>'800 tấn',           'qty'=>'20', 'quality'=>'95%'],
            ['name'=>'Máy phát điện (sản xuất tại Nhật Bản)',               'category'=>'Thiết bị nền móng', 'power'=>'5–15 kW',           'qty'=>'05', 'quality'=>'95%'],
            ['name'=>'Máy toàn đạc điện tử Nikon DTM-350 (Nhật Bản)',      'category'=>'Thiết bị nền móng', 'power'=>'—',                 'qty'=>'05', 'quality'=>'95%'],
            ['name'=>'Máy thủy chuẩn AL 32 (sản xuất tại Nhật Bản)',       'category'=>'Thiết bị nền móng', 'power'=>'—',                 'qty'=>'05', 'quality'=>'95%'],
            ['name'=>'Đối trọng đúc sẵn (sản xuất tại Việt Nam)',           'category'=>'Thiết bị nền móng', 'power'=>'—',                 'qty'=>'2.000 tấn','quality'=>'95%'],
            ['name'=>'Dầm chính I (sản xuất tại Việt Nam)',                 'category'=>'Thiết bị nền móng', 'power'=>'—',                 'qty'=>'20', 'quality'=>'99%'],
            ['name'=>'Dầm phụ I (sản xuất tại Việt Nam)',                   'category'=>'Thiết bị nền móng', 'power'=>'—',                 'qty'=>'10', 'quality'=>'99%'],
            ['name'=>'Tôn gối kê (sản xuất tại Việt Nam)',                  'category'=>'Thiết bị nền móng', 'power'=>'—',                 'qty'=>'10', 'quality'=>'98%'],
            ['name'=>'Đồng hồ áp suất (sản xuất tại Trung Quốc)',           'category'=>'Thiết bị nền móng', 'power'=>'60 MPa',            'qty'=>'15', 'quality'=>'99%'],
            ['name'=>'Đồng hồ đo lún (sản xuất tại Trung Quốc)',            'category'=>'Thiết bị nền móng', 'power'=>'50 mm',             'qty'=>'30', 'quality'=>'99%'],
            ['name'=>'Máy PDA (sản xuất tại Trung Quốc)',                   'category'=>'Thiết bị nền móng', 'power'=>'—',                 'qty'=>'02', 'quality'=>'99%'],
            ['name'=>'Máy PIT',                                             'category'=>'Thiết bị nền móng', 'power'=>'—',                 'qty'=>'04', 'quality'=>'98%'],

            ['name'=>'Máy siêu âm chiều dày lớp bê tông, bảo vệ đường kính cốt thép', 'category'=>'Thiết bị kiểm tra kết cấu công trình', 'unit'=>'Chiếc','qty'=>'01','function'=>'Kiểm tra đánh giá chất lượng kết cấu BTCT'],
            ['name'=>'Súng bật nẩy, máy siêu âm bê tông',                            'category'=>'Thiết bị kiểm tra kết cấu công trình', 'unit'=>'Chiếc','qty'=>'01','function'=>'Kiểm tra chất lượng bê tông'],
            ['name'=>'Máy siêu âm khuyết tật mối hàn',                               'category'=>'Thiết bị kiểm tra kết cấu công trình', 'unit'=>'Chiếc','qty'=>'01','function'=>'Kiểm tra chất lượng mối hàn'],

            ['name'=>'Cân phân tích 0.001g',                'category'=>'Thiết bị thí nghiệm vật liệu xây dựng', 'unit'=>'Chiếc','qty'=>'01','function'=>'Cân mẫu có trọng lượng < 200g'],
            ['name'=>'Máy thử thấm bê tông',                'category'=>'Thiết bị thí nghiệm vật liệu xây dựng', 'unit'=>'Chiếc','qty'=>'05','function'=>'Thử thấm bê tông'],
            ['name'=>'Máy thử kéo nén WEW-1000B',           'category'=>'Thiết bị thí nghiệm vật liệu xây dựng', 'unit'=>'Chiếc','qty'=>'02','function'=>'Thí nghiệm kéo nén'],
            ['name'=>'Máy nén',                             'category'=>'Thiết bị thí nghiệm vật liệu xây dựng', 'unit'=>'Chiếc','qty'=>'03','function'=>'Xác định cường độ bê tông'],
            ['name'=>'Máy sàng, bộ sàng',                   'category'=>'Thiết bị thí nghiệm vật liệu xây dựng', 'unit'=>'Chiếc','qty'=>'01','function'=>'Kiểm tra cốt liệu'],
            ['name'=>'Máy nén vữa TYA-300',                 'category'=>'Thiết bị thí nghiệm vật liệu xây dựng', 'unit'=>'Chiếc','qty'=>'—', 'function'=>'Kiểm tra cường độ'],
            ['name'=>'Máy CBR',                             'category'=>'Thiết bị thí nghiệm vật liệu xây dựng', 'unit'=>'Chiếc','qty'=>'01','function'=>'Kiểm tra nén mẫu CBR'],
            ['name'=>'Bộ dụng cụ thí nghiệm Bentonite',     'category'=>'Thiết bị thí nghiệm vật liệu xây dựng', 'unit'=>'Bộ',   'qty'=>'02','function'=>'Thí nghiệm Bentonite'],
            ['name'=>'Thùng chưng hấp mẫu bê tông xi măng','category'=>'Thiết bị thí nghiệm vật liệu xây dựng', 'unit'=>'Chiếc','qty'=>'01','function'=>'Bảo dưỡng bê tông mẫu'],
            ['name'=>'Máy khoan rút lõi bê tông',           'category'=>'Thiết bị thí nghiệm vật liệu xây dựng', 'unit'=>'Chiếc','qty'=>'02','function'=>'Khoan rút lõi bê tông'],
            ['name'=>'Thiết bị chế tạo bê tông',            'category'=>'Thiết bị thí nghiệm vật liệu xây dựng', 'unit'=>'Chiếc','qty'=>'01','function'=>'Chế tạo thử mẫu'],
        ];

        foreach ($items as $index => $data) {
            Equipment::create([
                'name' => $data['name'],
                'category' => $data['category'],
                'power' => $data['power'] ?? null,
                'unit' => $data['unit'] ?? null,
                'qty' => $data['qty'] ?? null,
                'quality' => $data['quality'] ?? null,
                'function' => $data['function'] ?? null,
                'sort_order' => $index + 1,
                'status' => 'published',
            ]);
        }
    }
}
