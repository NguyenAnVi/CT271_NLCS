<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->insert([
            [
                'name' => 'ROOT',
                'phone' => 'ROOT',
                'password' => bcrypt('root'),
            ],
            [
                'name' => 'Admin01',
                'phone' => '01',
                'password' => bcrypt('01'),
            ],
            [
                'name' => 'Admin02',
                'phone' => '02',
                'password' => bcrypt('02'),
            ],
            [
                'name' => 'Admin03',
                'phone' => '03',
                'password' => bcrypt('03'),
            ],
            [
                'name' => 'Admin04',
                'phone' => '04',
                'password' => bcrypt('04'),
            ],
            [
                'name' => 'Admin05',
                'phone' => '05',
                'password' => bcrypt('05'),
            ],
            [
                'name' => 'Admin06',
                'phone' => '06',
                'password' => bcrypt('06'),
            ],
        ]);

        DB::table('users')->insert([
            [
                'name' => 'User01',
                'phone' => '1',
                'password' => bcrypt('1'),
                'point' => 0,
            ],
            [
                'name' => 'User02',
                'phone' => '2',
                'password' => bcrypt('1'),
                'point' => 0,
            ],
            [
                'name' => 'User03',
                'phone' => '3',
                'password' => bcrypt('1'),
                'point' => 0,
            ],
            [
                'name' => 'User04',
                'phone' => '4',
                'password' => bcrypt('1'),
                'point' => 0,
            ],
            [
                'name' => 'User05',
                'phone' => '5',
                'password' => bcrypt('1'),
                'point' => 0,
            ],
            [
                'name' => 'User06',
                'phone' => '6',
                'password' => bcrypt('1'),
                'point' => 0,
            ],
            [
                'name' => 'User07',
                'phone' => '7',
                'password' => bcrypt('1'),
                'point' => 0,
            ],
            [
                'name' => 'User08',
                'phone' => '8',
                'password' => bcrypt('1'),
                'point' => 0,
            ],
            [
                'name' => 'User09',
                'phone' => '9',
                'password' => bcrypt('1'),
                'point' => 0,
            ],
            [
                'name' => 'User10',
                'phone' => '10',
                'password' => bcrypt('1'),
                'point' => 0,
            ],
            [
                'name' => 'User11',
                'phone' => '11',
                'password' => bcrypt('1'),
                'point' => 0,
            ],
            [
                'name' => 'User12',
                'phone' => '12',
                'password' => bcrypt('1'),
                'point' => 0,
            ],
        ]);

        DB::table('saleoffs')->insert([
            [
                'name' => 'NONE',
                'amount' => 0,
                'percent' => 0,
                'starttime' => '2022-10-04 15:43:00',
                'endtime' => '2022-10-04 15:43:00',
                'imageurl' => ''
            ],
            [
                'name' => 'Siêu deal vui khỏe - Dành cho sản phẩm Chăm sóc cá nhân',
                'amount' => '55000',
                'percent' => 0,
                'starttime' => '2022-10-04 15:43:00',
                'endtime' => '2022-10-31 15:42:00',
                'imageurl' => 'http://127.0.0.1:8000/storage/saleoff/banners/1.webp'
            ],
            [
                'name' => 'Siêu deal vui khỏe - Dành cho các sản phẩm chăm sóc sắc đẹp',
                'amount' => 0,
                'percent' => '5',
                'starttime' => '2022-10-04 15:43:00',
                'endtime' => '2022-10-31 15:42:00',
                'imageurl' => 'http://127.0.0.1:8000/storage/saleoff/banners/2.webp'
            ],
            [
                'name' => 'KM khi mua Solga',
                'amount' => 0,
                'percent' => '30',
                'starttime' => '2022-10-04 15:43:00',
                'endtime' => '2022-10-31 15:42:00',
                'imageurl' => 'http://127.0.0.1:8000/storage/saleoff/banners/3.webp'
            ],
            [
                'name' => 'Tri ân khách hàng',
                'amount' => 0,
                'percent' => '30',
                'starttime' => '2022-10-04 15:43:00',
                'endtime' => '2022-10-31 15:42:00',
                'imageurl' => 'http://127.0.0.1:8000/storage/saleoff/banners/4.jpg'
            ],
            [
                'name' => 'Black Friday',
                'amount' => '50000',
                'percent' => 0,
                'starttime' => '2022-10-04 15:43:00',
                'endtime' => '2022-10-31 15:42:00',
                'imageurl' => 'http://127.0.0.1:8000/storage/saleoff/banners/5.jpg'
            ],
        ]);
        DB::unprepared(
            "INSERT INTO nhathuocsuckhoedb.products
                (name,detail,price, images, saleoff_id)
            VALUES
                ('Băng cá nhân che phủ vết thương Urgo Optiskin 10cm x 7cm (3 miếng)', '<p><strong>Th&agrave;nh phần</strong><br>Bao gồm một lớp mỏng polyurethane phủ keo acrylic c&oacute; t&iacute;nh dung nạp qua da cao v&agrave; lớp gạc thấm h&uacute;t kh&ocirc;ng dệt c&oacute; khả năng thấm h&uacute;t cao, được bao phủ bởi một lớp vảo vệ polyethylene kh&ocirc;ng d&iacute;nh. Chất keo được bảo vệ bởi hai c&aacute;nh c&oacute; r&atilde;nh v&agrave; băng được bao bởi một lớp film trong suốt gi&uacute;p băng vết thương dễ d&agrave;ng hơn. Băng được khử tr&ugrave;ng bằng ethylene oxide.</p><p><strong>Ưu điểm</strong><br>Optiskin l&agrave; loại băng gạc b&aacute;m d&iacute;nh v&ocirc; tr&ugrave;ng c&oacute; t&iacute;nh b&aacute;n thấm.<br>- Kh&aacute;ng khuẩn v&agrave; ngăn ngừa nhiễm tr&ugrave;ng từ b&ecirc;n ngo&agrave;i.<br>- B&aacute;n thấm, cho kh&iacute; v&agrave; hơi nước đi qua, do đ&oacute; ngăn ngừa nguy cơ hăm da v&agrave; cho ph&eacute;p lưu băng d&agrave;i ng&agrave;y.<br>- Kh&ocirc;ng thấm nước gi&uacute;p bệnh nh&acirc;n c&oacute; thể tắm rửa, vệ sinh.<br>- Mềm mại, co gi&atilde;n c&oacute; thể băng bất cứ chỗ n&agrave;o tr&ecirc;n c&oacute; thể m&agrave; vẫn cử động b&igrave;nh thường.<br>- Trong suốt, gi&uacute;p dễ d&agrave;ng theo d&otilde;i mức độ thấm h&uacute;t của băng.<br>- Băng ph&ugrave; hợp với cả da nhạy cảm.</p><p><strong>C&ocirc;ng dụng</strong><br>Optiskin l&agrave; băng gạc sử dụng để bao phủ l&ecirc;n tất cả c&aacute;c vết thương ngo&agrave;i da (vết kh&acirc;u, vết trầy xước), hoặc c&aacute;c loại dụng cụ (que d&ograve;, ống dẫn...). Do Optiskin cho ph&eacute;p bệnh nh&acirc;n c&oacute; thể tắm rửa, vệ sinh n&ecirc;n băng đặc biệt ph&ugrave; hợp cho c&aacute;c liệu ph&aacute;p tắm ng&acirc;m hay n&oacute;i chung nhanh ch&oacute;ng bắt đầu lại c&aacute;c hoạt động sau phẫu thuật.</p><p><strong>Hướng dẫn sử dụng</strong><br>1. Chuẩn bị da: Cạo l&ocirc;ng nếu cẩn thiết đảm bảo băng d&iacute;nh chắc hơn. Cầm m&agrave;u vết thương. S&aacute;t tr&ugrave;ng to&agrave;n bộ v&ugrave;ng vết thương hoặc v&ugrave;ng d&aacute;n băng. Lau da thật kh&ocirc;.<br>2. D&aacute;n băng: Lấy băng optiskin ra khỏi bao giấy. Giữ hai c&aacute;nh giấy bảo vệ bằng ng&oacute;n c&aacute;i v&agrave; ng&oacute;n trỏ, hướng mặt keo v&agrave; &aacute;p gạc xuống vết thương. &Aacute;p mặt keo xuống rồi k&eacute;o hai c&aacute;nh giấy ra hai ph&iacute;a. Ấn nhẹ l&ecirc;n băng để &aacute;p keo cho d&iacute;nh. Lấy bỏ hai c&aacute;nh trong suốt ở ph&iacute;a ngo&agrave;i băng, bắt đầu từ khe giữa. Vuốt nhẹ từ giữa băng ra ngo&agrave;i để d&iacute;nh chắc hơn nữa.<br>3. Bỏ băng: Gỡ một m&eacute;p băng rồi nhẹ nh&agrave;ng k&eacute;o thẳng ra ngo&agrave;i để l&agrave;m căng v&agrave; tr&oacute;c keo trong l&uacute;c tay kia giữ cạnh băng b&ecirc;n kia để tạo đối lực. Gỡ như vậy bệnh nh&acirc;n sẽ kh&ocirc;ng đau v&agrave; da &iacute;t bị k&iacute;ch th&iacute;ch d&ugrave; phải thay băng nhiều lần.</p><p><em>Lưu &yacute;:</em><br>- C&oacute; thể lưu băng đến 7 ng&agrave;y.<br>- Trước khi sử dụng, kiểm tra t&igrave;nh trạng nguy&ecirc;n vẹn của bao b&igrave; băng để đảm bảo băng v&ocirc; tr&ugrave;ng.<br>- Tr&aacute;nh k&eacute;o căng khi d&aacute;n băng.<br>- Kh&ocirc;ng sử dụng băng cho c&aacute;c vết thương hoặc c&aacute;c vết thương bị nhiễm tr&ugrave;ng, đang ra m&aacute;u hoặc tiết dịch nhiều.<br>- Theo d&otilde;i thường xuy&ecirc;n vết thương v&agrave; v&ugrave;ng da xung quanh để ph&aacute;t hiện ngay c&aacute;c dấu hiệu nhiễm tr&ugrave;ng như: đau, đỏ, ph&ugrave; nề, c&oacute; m&ugrave;i h&ocirc;i hoặc mưng mủ bất thường.<br>- Kh&ocirc;ng d&ugrave;ng Optiskin để bao l&ecirc;n c&aacute;c ống th&ocirc;ng tĩnh mạch trung t&acirc;m. Sử dụng một lần, kh&ocirc;ng tiệt tr&ugrave;ng để sử dụng lại.</p><p><strong>Đ&oacute;ng g&oacute;i:</strong> Hộp 3 miếng, k&iacute;ch thước 10 cm x 7 cm</p><p><strong>Xuất xứ thương hiệu:</strong> Th&aacute;i Lan</p><p><strong>Sản xuất tại:</strong> Th&aacute;i Lan<br>&emsp;</p>', '50000', '[\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/1\\/1Bng-c-nhn-che-ph-vt-thng-Urgo-Optiskin-10cm-x-7cm-3-ming-1665077397.webp\",\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/1\\/2Bng-c-nhn-che-ph-vt-thng-Urgo-Optiskin-10cm-x-7cm-3-ming-1665077397.webp\"]', '1'),
                ('Băng cá nhân cho phụ nữ Urgo Women (Gói 10 miếng)', '<p><strong>Th&agrave;nh phần:&nbsp;</strong>Nền Polyethylene Film, keo Acrylic, m&agrave;ng Polyethylene.</p><p><br></p><p><strong>C&ocirc;ng dụng:&nbsp;</strong>Gi&uacute;p bảo vệ viết thương nhỏ, vết cắt, vết kim đ&acirc;m, vết trầy xước kh&ocirc;ng l&agrave;m trẻ đau.</p><p><br></p><p><strong>C&aacute;ch sử dụng:&nbsp;</strong>D&ugrave;ng tr&ecirc;n da l&agrave;nh, sạch v&agrave; kh&ocirc;, h&ocirc;ng k&eacute;o căng băng hoặc da. D&ugrave;ng ng&oacute;n tay vướt nhẹ miếng băng.</p><p><br></p><p><strong>Bảo quản:&nbsp;</strong>Nơi kh&ocirc; r&aacute;o tho&aacute;ng m&aacute;t, tr&aacute;nh &aacute;nh nắng v&agrave; nhiệt độ cao.</p><p><br></p><p><strong>Quy c&aacute;ch đ&oacute;ng g&oacute;i:&nbsp;</strong>G&oacute;i 10 miếng&nbsp;</p><p><br></p><p><strong>Xuất xứ thương hiệu:</strong> Ph&aacute;p</p><p><br></p><p><strong>Sản xuất tại:</strong> Th&aacute;i Lan</p><p><br></p><p><em>*Pharmacity cam kết chỉ b&aacute;n sản phẩm c&ograve;n d&agrave;i hạn sử dụng</em></p>', '13000', '[\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/2\\/1Bng-c-nhn-cho-ph-n-Urgo-Women-Gi-10-ming-1665077571.webp\"]', '2'),
                ('Băng cá nhân vải độ dính cao Urgo Durable (102 miếng/hộp)', '<p>Băng c&aacute; nh&acirc;n độ d&iacute;nh cao Urgo Durable được l&agrave;m từ chất liệu vải co gi&atilde;n tốt, gạc mềm phủ lưới Polyethylene kh&ocirc;ng g&acirc;y d&iacute;nh hoặc đau khi gỡ băng, gi&uacute;p bảo vệ ho&agrave;n hảo c&aacute;c vết thương nhỏ, vết trầy xước, r&aacute;ch da. C&aacute;c miếng băng được đựng trong bao ri&ecirc;ng, đảm bảo vệ sinh v&agrave; dễ d&agrave;ng bảo quản.&nbsp;</p><p><strong>Th&agrave;nh phần:&nbsp;</strong><br>Polyethylene</p><p><strong>C&ocirc;ng dụng:</strong><br>Gi&uacute;p bảo vệ c&aacute;c vết thương nhỏ, vết trầy xước, r&aacute;ch da.</p><p><strong>C&aacute;ch sử dụng:</strong><br>Vệ sinh, s&aacute;t khuẩn, rửa sạch v&agrave; lau kh&ocirc; nhẹ nh&agrave;ng vết thương v&agrave; khu vực xung quanh vết thương. D&aacute;n băng c&aacute; nh&acirc;n, vuốt nhẹ miếng băng. Thay băng &iacute;t nhất 2 lần mỗi ng&agrave;y.</p><p><strong>Bảo quản:</strong>&nbsp;<br>Nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh tiếp x&uacute;c trực tiếp với &aacute;nh nắng mặt trời.</p><p><strong>Quy c&aacute;ch đ&oacute;ng g&oacute;i:</strong> Hộp 102 miếng</p><p><strong>Xuất xứ thương hi&ecirc;u:</strong> Ph&aacute;p</p><p><strong>Sản xuất tại:</strong> Th&aacute;i Lan</p><p><em>*Pharmacity cam kết chỉ b&aacute;n sản phẩm c&ograve;n d&agrave;i hạn sử dụng.</em></p>', '68000', '', '2'),
                ('Băng cá nhân vải độ dính cao Urgo Durable (102 miếng/hộp)', '<p>Băng c&aacute; nh&acirc;n độ d&iacute;nh cao Urgo Durable được l&agrave;m từ chất liệu vải co gi&atilde;n tốt, gạc mềm phủ lưới Polyethylene kh&ocirc;ng g&acirc;y d&iacute;nh hoặc đau khi gỡ băng, gi&uacute;p bảo vệ ho&agrave;n hảo c&aacute;c vết thương nhỏ, vết trầy xước, r&aacute;ch da. C&aacute;c miếng băng được đựng trong bao ri&ecirc;ng, đảm bảo vệ sinh v&agrave; dễ d&agrave;ng bảo quản.&nbsp;</p><p><strong>Th&agrave;nh phần:&nbsp;</strong><br>Polyethylene</p><p><strong>C&ocirc;ng dụng:</strong><br>Gi&uacute;p bảo vệ c&aacute;c vết thương nhỏ, vết trầy xước, r&aacute;ch da.</p><p><strong>C&aacute;ch sử dụng:</strong><br>Vệ sinh, s&aacute;t khuẩn, rửa sạch v&agrave; lau kh&ocirc; nhẹ nh&agrave;ng vết thương v&agrave; khu vực xung quanh vết thương. D&aacute;n băng c&aacute; nh&acirc;n, vuốt nhẹ miếng băng. Thay băng &iacute;t nhất 2 lần mỗi ng&agrave;y.</p><p><strong>Bảo quản:</strong>&nbsp;<br>Nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh tiếp x&uacute;c trực tiếp với &aacute;nh nắng mặt trời.</p><p><strong>Quy c&aacute;ch đ&oacute;ng g&oacute;i:</strong> Hộp 102 miếng</p><p><strong>Xuất xứ thương hi&ecirc;u:</strong> Ph&aacute;p</p><p><strong>Sản xuất tại:</strong> Th&aacute;i Lan</p><p><em>*Pharmacity cam kết chỉ b&aacute;n sản phẩm c&ograve;n d&agrave;i hạn sử dụng.</em></p>', '68000', '', '2'),
                ('Bàn chải đánh răng Colgate Cushion Clean (Vỉ 2 cái)', '<p style=\"text-align: justify;\"><strong>Ưu điểm</strong><br>L&ocirc;ng b&agrave;n chải d&agrave;y hơn đến 7 lần<br>Đầu b&agrave;n chải mỏng chỉ 3,5mm dễ d&agrave;ng chải sạch s&acirc;u b&ecirc;n trong<br>Nhẹ nh&agrave;ng chải sạch răng v&agrave; m&aacute;t-xa nướu</p><p style=\"text-align: justify;\"><strong>Th&agrave;nh phần</strong><br>PBT, TPE</p><p style=\"text-align: justify;\"><strong>Th&ocirc;ng số kĩ thuật</strong><br>Lực k&eacute;o cước &gt;= 1,8kg</p><p style=\"text-align: justify;\"><strong>Hướng dẫn sử dụng</strong><br>N&ecirc;n thay b&agrave;n chải &iacute;t nhất 3 th&aacute;ng một lần hoặc khi l&ocirc;ng b&agrave;n chải m&ograve;n v&agrave; tưa.</p><p style=\"text-align: justify;\"><strong>Đ&oacute;ng g&oacute;i:</strong> Vỉ 2 b&agrave;n chải</p><p style=\"text-align: justify;\"><strong>Xuất xứ thương hiệu:</strong> H&agrave; Lan</p><p style=\"text-align: justify;\"><strong>Sản xuất tại:</strong> Trung Quốc</p>', '85000', '[\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/5\\/1Bn-chi-nh-rng-Colgate-Cushion-Clean-V-2-ci-1665077777.webp\",\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/5\\/2Bn-chi-nh-rng-Colgate-Cushion-Clean-V-2-ci-1665077777.webp\"]', '2'),
                ('Gel rửa mặt Acnes 25+ Facial Wash (Tuýp 100g)', '<p><strong>Th&agrave;nh phần</strong></p><p>Water, Disodium Cocoyl Glutamate, Lauryl Glucoside, Glycerin, Sorbitol, Sodium Cocoyl Glycinate, Potassium Cocoyl Glycinate, Acrylates Copolymer, Sodium Chloride, Maltooligosyl Glucoside&hellip;</p><p><br></p><p><strong>C&ocirc;ng dụng</strong></p><p>Gel rửa mặt ngăn ngừa mụn, kiểm so&aacute;t t&igrave;nh trạng mụn, mờ đốm n&acirc;u, da ẩm mịn.</p><p><br></p><p><strong>Đối tượng sử dụng</strong></p><p>Sản phẩm th&iacute;ch hợp sử dụng cho da c&oacute; mụn ở người c&oacute; độ tuổi trưởng th&agrave;nh (từ 25 tuổi trở l&ecirc;n).</p><p><br></p><p><strong>C&aacute;ch sử dụng</strong></p><p>Bước 1: Acnes 25+ Facial Wash</p><p>L&agrave;m ướt mặt, lấy lượng gel vừa đủ v&agrave;o l&ograve;ng b&agrave;n tay, tạo bọt v&agrave; thoa đều khắp mặt. Rửa sạch với nhiều nước.</p><p>Bước 2: Acnes 25+ Facial Serum</p><p>L&agrave;m ướt mặt, lấy một lượng vừa đủ v&agrave;o l&ograve;ng b&agrave;n tay, tạo bọt v&agrave; thoa đều khắp mặt. Rửa sạch lại với nhiều nước.</p><p><br></p><p><strong>Bảo quản:</strong> Nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh tiếp x&uacute;c &aacute;nh nắng.</p><p><br></p><p><strong>Đ&oacute;ng g&oacute;i:</strong> 100g</p><p><br></p><p><strong>Xuất xứ thương hiệu</strong>: Nhật Bản</p><p><br></p><p><strong>Nh&agrave; sản xuất:</strong> Rohto-Mentholatum</p><p><br></p><p><strong>C&ocirc;ng ty ph&acirc;n phối:&nbsp;</strong>C&ocirc;ng ty TNHH Dịch vụ-Thương mại Thanh Ngọc</p><p><br></p><p><strong>Số Giấy c&ocirc;ng bố:</strong> 229/20/CBMP-BD</p><p><br></p><p><br></p>', '82000', '[\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/6\\/1Gel-ra-mt-Acnes-25-Facial-Wash-Tup-100g-1665077914.webp\"]', '3'),
                ('Mặt nạ Ariul 7days Mask Aloe H (23ml)', '<p><strong>Th&agrave;nh phần</strong><br>Water, Glycerin, Dipropylene Glycol, Butylene Glycol, Dipotassium Glycyrrhizate, Squalane, Cetearyl Olivate, Sorbitan Olivate, Allantoin, Acrylates/C10-30 Alkyl Acrylate Crosspolymer, Sodium Hyaluronate, Tromethamine, Lactobacillus/Aloe Barbadensis Ferment Filtrate, 1,2-Hexanediol, Ceramide NP, Palmitoyl Tripeptide-5, Phytosterols, Hydroxyacetophenone, Caprylyl Glycol, Sodium Phytate, Ethylhexylglycerin, Tocopherol</p><p><strong>C&ocirc;ng dụng&nbsp;</strong><br>Mặt nạ gi&uacute;p dưỡng ẩm v&agrave; l&agrave;m dịu da, gi&uacute;p mang lại l&agrave;n da mềm mịn, căng mướt. Mặt nạ chăm s&oacute;c v&agrave; dưỡng da h&agrave;ng ng&agrave;y. Ph&ugrave; hợp với da kh&ocirc;.</p><p><strong>C&aacute;ch sử dụng:&nbsp;</strong>L&agrave;m sạch da v&agrave; d&ugrave;ng nước c&acirc;n bằng. Mở t&uacute;i lấy mặt nạ ra v&agrave; đắp l&ecirc;n mặt, điều chỉnh theo khu vực mắt v&agrave; mũi trước. Gỡ bỏ mặt nạ sau 10-20 ph&uacute;t v&agrave; vỗ nhẹ nh&agrave;ng l&ecirc;n da để lượng tinh chất c&ograve;n thừa thẩm thấu hết v&agrave;o da.</p><p><strong>Bảo quản:</strong> Nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t. Tr&aacute;nh &aacute;nh nắng trực tiếp<br><strong>Thương hiệu:</strong> Ariul</p><p><strong>Sản xuất tại:</strong> H&agrave;n Quốc</p><p><strong>T&ecirc;n nh&agrave; sản xuất:</strong> Ariul</p><p><strong>Số giấy c&ocirc;ng bố:</strong> 145280/21/CBMP-QLD</p><p><br><br><br></p>', '28000', '[\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/7\\/1Mt-n-Ariul-7days-Mask-Aloe-H-23ml-1665078534.webp\",\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/7\\/2Mt-n-Ariul-7days-Mask-Aloe-H-23ml-1665078534.webp\",\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/7\\/3Mt-n-Ariul-7days-Mask-Aloe-H-23ml-1665078534.webp\"]', '3'),
                ('Viên dầu anh thảo Solgar Evening Primrose Oil 1300 mg (Chai 60 viên)', '<p><strong>C&ocirc;ng dụng&nbsp;</strong><br>- Hỗ trợ giữ ẩm, gi&uacute;p bảo vệ nu&ocirc;i dưỡng v&agrave; giữ g&igrave;n cho da.<br>- Hỗ trợ duy tr&igrave; v&agrave; điều h&ograve;a nội tiết tố nữ.</p><p><strong>Th&agrave;nh phần&nbsp;</strong><br>Mỗi vi&ecirc;n n&eacute;n chứa:<br>- Dầu hoa Anh Thảo (Evening Primrose) 1300mg chứa Linoleic Acid 949mg, Gamma - Linolenic Acid 117 mg.<br>- Phụ liệu: Gelatin, Glycerin thực vật.</p><p><strong>Đối tượng sử dụng&nbsp;</strong><br>Người lớn tr&ecirc;n 19 tuổi.<br>Lưu &yacute;: Người đang điều trị c&aacute;c bệnh đặc biệt kh&aacute;c hay phụ nữ c&oacute; thai cần hỏi b&aacute;c sỹ trước khi sử dụng.</p><p><strong>Hướng dẫn sử dụng&nbsp;</strong><br>Uống ngay sau bữa ăn. Người lớn uống 1 vi&ecirc;n/lần x 1-2 lần/ng&agrave;y.</p><p><strong>Đ&oacute;ng g&oacute;i:</strong> Chai 60 vi&ecirc;n</p><p><strong>Bảo quản:</strong> Nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t v&agrave; tr&aacute;nh &aacute;nh nắng.</p><p><strong>Xuất xứ thương hiệu:</strong> Mỹ</p><p><strong>Sản xuất tại:</strong> Mỹ<br><br><em>Sản phẩm n&agrave;y kh&ocirc;ng phải l&agrave; thuốc v&agrave; kh&ocirc;ng c&oacute; t&aacute;c dụng thay thế thuốc chữa bệnh.</em></p>', '805000', '[\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/8\\/1Vin-du-anh-tho-Solgar-Evening-Primrose-Oil-1300-mg-Chai-60-vin-1665078717.webp\",\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/8\\/2Vin-du-anh-tho-Solgar-Evening-Primrose-Oil-1300-mg-Chai-60-vin-1665078717.webp\"]', '4'),
                ('Viên dưỡng mắt Lutein 20mg Solgar (Lọ 60 Viên)', '<p><strong>C&ocirc;ng dụng:&nbsp;</strong>Hỗ trợ tăng cường sức khỏe cho mắt.</p><p><strong>Đối tượng sử dụng:</strong> Người lớn tr&ecirc;n 19 tuổi.</p><p><em>Lưu &yacute;:</em> Người đang điều trị c&aacute;c bệnh đặc biệt kh&aacute;c hay phụ nữ c&oacute; thai cần hỏi b&aacute;c sĩ trước khi sử dụng.</p><p><strong>Th&agrave;nh phần:</strong> Mỗi vi&ecirc;n chứa 20mg lutein v&agrave; phụ liệu.</p><p><strong>Hướng dẫn sử dụng:&nbsp;</strong>Người lớn uống 1 vi&ecirc;n/lần x 1 lần/ng&agrave;y. Uống c&ugrave;ng với bữa ăn hoặc theo hướng dẫn của chuy&ecirc;n gia y tế.</p><p><strong>Đ&oacute;ng g&oacute;i:</strong> Lọ 60 vi&ecirc;n</p><p><strong>Bảo quản:</strong> Nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh &aacute;nh s&aacute;ng.</p><p><strong>Xuất xứ thương hiệu:</strong> Hoa Kỳ</p><p><strong>Sản xuất tại:</strong> Hoa Kỳ</p><p><em>*Sản phẩm n&agrave;y kh&ocirc;ng phải l&agrave; thuốc, kh&ocirc;ng c&oacute; t&aacute;c dụng thay thế thuốc chữa bệnh.</em></p><p>&nbsp;</p>', '1531000', '[\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/9\\/1Vin-dng-mt-Lutein-20mg-Solgar-L-60-Vin-1665078815.webp\",\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/9\\/2Vin-dng-mt-Lutein-20mg-Solgar-L-60-Vin-1665078815.webp\"]', '4'),
                ('Dụng cụ xét nghiệm nhanh COVID-19 COVICHEK COVID-19 Ag Test Kit (Hộp 5 bộ kit)', '<p>COVICHEK COVID-19 Ag Kit l&agrave; phương ph&aacute;p x&eacute;t nghiệm miễn dịch sắc k&yacute; để ph&aacute;t hiện định t&iacute;nh kh&aacute;ng nguy&ecirc;n cụ thể đối với COVID-19 c&oacute; trong tăm b&ocirc;ng mũi họng, dịch mũi họng v&agrave; đờm ở người.</p><p><strong>Th&ocirc;ng số kỹ thuật</strong><br>Protein mục ti&ecirc;u: Nucleocapsid Protein of SARS-CoV-2<br>Phương ph&aacute;p: Sắc k&yacute; miễn dịch (Immunochromatographic)<br>Độ nhạy: 96.11%<br>Độ đặc hiệu: 99.78%</p><p><strong>Th&agrave;nh phần</strong><br>5 Dụng cụ kiểm tra<br>5 Ống đệm chiết<br>5 Nắp đậy vật mẫu<br>5 Gạc tiệt tr&ugrave;ng để lấy mẫu (8cm)<br>01 Tờ Hướng dẫn sử dụng</p><p><strong>Hướng dẫn sử dụng</strong><br>1. L&agrave;m sạch nước mũi.<br>2. Đưa tăm b&ocirc;ng v&agrave;o mũi trước v&agrave;o một trong c&aacute;c lỗ mũi v&agrave; xoay tăm b&ocirc;ng v&agrave;o th&agrave;nh mũi 5-6 lần.<br>3. Th&aacute;o con dấu gắn v&agrave;o ống đệm chiết. Ch&egrave;n miếng gạc v&agrave;o ống đệm chiết.<br>4. Khuấy tăm b&ocirc;ng &iacute;t nhất 8 ~ 10 lần. Ấn đầu v&agrave;o b&ecirc;n trong ống.<br>5. Ấn chặt nắp v&agrave;o ống. Nhỏ 4 giọt mẫu đ&atilde; chiết v&agrave;o lỗ mẫu của thiết bị thử.<br>6. Đọc kết quả thử nghiệm trong 15 ~ 20 ph&uacute;t. Kh&ocirc;ng đọc sau 30 ph&uacute;t.</p><p><br></p><p><img src=\"http://127.0.0.1:8000/storage/products/10/5Dng-c-xt-nghim-nhanh-COVID-19-COVICHEK-COVID-19-Ag-Test-Kit-Hp-5-b-kit-1665079100.png\" class=\"fr-fic fr-dii\"></p><p><br></p><p><strong>Đ&oacute;ng g&oacute;i:</strong> Hộp 5 bộ kit</p><p><strong>Hạn sử dụng:</strong> 24 th&aacute;ng kể từ ng&agrave;y sản xuất.</p><p><strong>Bảo quản:</strong> 2 &ndash; 30℃</p><p><strong>Xuất xứ thương hiệu:</strong> H&agrave;n Quốc</p><p><strong>Sản xuất tại:</strong> WIZCHEM CO., LTD.<br>Bio Venture Town 401, Daejeon Techno-park, 1662, Yuseong-daero,<br>Yuseong-gu, Daejeon, 34054, Korea</p>', '425000', '[\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/10\\/1Dng-c-xt-nghim-nhanh-COVID-19-COVICHEK-COVID-19-Ag-Test-Kit-Hp-5-b-kit-1665079100.webp\",\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/10\\/2Dng-c-xt-nghim-nhanh-COVID-19-COVICHEK-COVID-19-Ag-Test-Kit-Hp-5-b-kit-1665079100.webp\",\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/10\\/3Dng-c-xt-nghim-nhanh-COVID-19-COVICHEK-COVID-19-Ag-Test-Kit-Hp-5-b-kit-1665079100.webp\",\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/10\\/4Dng-c-xt-nghim-nhanh-COVID-19-COVICHEK-COVID-19-Ag-Test-Kit-Hp-5-b-kit-1665079100.webp\",\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/10\\/5Dng-c-xt-nghim-nhanh-COVID-19-COVICHEK-COVID-19-Ag-Test-Kit-Hp-5-b-kit-1665079100.png\"]', '1'),
                ('Enzymax Kids Hỗ trợ bé hấp thu chất dinh dưỡng tốt hơn (Hộp 50 gói)', '<p><strong>Th&agrave;nh phần</strong></p><p>Trong mỗi g&oacute;i 2g c&oacute; chứa:Lipase 6,65 mg (2.000 FIP), Amylase 10,75 mg (1.075 DU), Glucoamylase 6,9 mg (7 AGU), Protease 3.0 3,75 mg (7.5 SAPU), Protease 4.5 1,95 mg (1.560 HUT).</p><p>Phụ liệu: fructose, glucose syrup, chất độn (maltodextrin), vị chuối (hương tự nhi&ecirc;n), chất chống đ&ocirc;ng v&oacute;n (silicon dioxide), chất tạo ngọt (sucralose).</p><p><br></p><p><strong>C&ocirc;ng dụng</strong></p><ul><li>Hỗ trợ tăng cường ti&ecirc;u h&oacute;a thức ăn, hỗ trợ hấp thu chất dinh dưỡng tốt hơn.</li><li>Hỗ trợ giảm c&aacute;c triệu chứng ăn kh&ocirc;ng ti&ecirc;u, đi ti&ecirc;u ph&acirc;n sống, biếng ăn chậm lớn, k&eacute;m hấp thu dinh dưỡng&hellip;do thiếu men ti&ecirc;u h&oacute;a.</li></ul><p>(Lipase: ti&ecirc;u h&oacute;a lipid (chất b&eacute;o); Amylase: ti&ecirc;u h&oacute;a carbohydrat (tinh bột, rau củ, đường&hellip;); Glucoamylase: ti&ecirc;u h&oacute;a tinh bột sống v&agrave; ch&iacute;n; Protease 3.0 v&agrave; 4.5: ti&ecirc;u h&oacute;a protein (đạm)).</p><p><br></p><p><strong>Đối tượng sử dụng:&nbsp;</strong>Trẻ c&oacute; c&aacute;c triệu chứng ăn kh&ocirc;ng ti&ecirc;u, đi ti&ecirc;u ph&acirc;n sống, biếng ăn chậm lớn, k&eacute;m hấp thu dinh dưỡng&hellip;do thiếu men ti&ecirc;u h&oacute;a. Sản phẩm sử dụng cho trẻ từ 3 tuổi trở l&ecirc;n.</p><p><br></p><p><strong>C&aacute;ch d&ugrave;ng:&nbsp;</strong>Uống v&agrave;o đầu bữa ăn ch&iacute;nh. Pha v&agrave;o ly nước 50ml, khuấy nhẹ đều trước khi uống.</p><ul><li>Trẻ em tr&ecirc;n 4 tuổi: 1-2 g&oacute;i/lần, ng&agrave;y 3 lần.</li><li>Trẻ em 3-4 tuổi: 1 g&oacute;i/lần, ng&agrave;y 3 lần.</li></ul><p><strong>Bảo quản:&nbsp;</strong>Nhiệt độ ph&ograve;ng, nơi kh&ocirc; r&aacute;o, tho&aacute;ng m&aacute;t, tr&aacute;nh độ ẩm v&agrave; &aacute;nh nắng mặt trời.</p><p><br></p><p><strong>Đ&oacute;ng g&oacute;i:</strong> 50 g&oacute;i/hộp.</p><p><br></p><p><strong>Xuất xứ thương hiệu:&nbsp;</strong>T&acirc;y Ban Nha.</p><p><br></p><p><strong>Sản xuất tại:</strong> T&acirc;y Ban Nha.</p><p><br></p><p><strong>Số GPCB:&nbsp;</strong>2557/2022/ĐKSP</p><p><br></p><p><strong>Số giấy XNQC:&nbsp;</strong>1283/2022/XNQC-ATTP</p><p><br></p><p><em>Thực phẩm n&agrave;y kh&ocirc;ng phải l&agrave; thuốc v&agrave; kh&ocirc;ng c&oacute; t&aacute;c dụng thay thế thuốc chữa bệnh.</em></p>', '600000', '[\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/11\\/1Enzymax-Kids-H-tr-b-hp-thu-cht-dinh-dng-tt-hn-Hp-50-gi-1665079551.webp\",\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/11\\/2Enzymax-Kids-H-tr-b-hp-thu-cht-dinh-dng-tt-hn-Hp-50-gi-1665079551.webp\",\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/11\\/3Enzymax-Kids-H-tr-b-hp-thu-cht-dinh-dng-tt-hn-Hp-50-gi-1665079551.webp\"]', '6'),
                ('Bộ sản phẩm size nhỏ du lịch Pharmacist Formulators Sữa rửa mặt dưỡng ẩm- Kem dưỡng ẩm chống nắng - Serum dưỡng ẩm', '<p><strong>Sữa rửa mặt dưỡng ẩm - Moisturising Cleansing Milk</strong></p><p><strong>Th&agrave;nh phần&nbsp;</strong><br>Aqua, Glycerin, Lauryl glucoside, Cetearyl alcohol, Glyceryl stearate, Palmitic acid, Stearic acid, Phenoxyethanol, Propylene glycol&hellip;</p><p><strong>C&ocirc;ng dụng:&nbsp;</strong>Gi&uacute;p làm sạch bã nhờn và bụi b&acirc;̉n tr&ecirc;n da, giữ &acirc;̉m cho da, giúp da săn chắc.</p><p><strong>Hướng dẫn sử dụng:&nbsp;</strong>Cho một &iacute;t sữa rửa mặt v&agrave;o l&ograve;ng b&agrave;n tay hoặc b&ocirc;ng thấm. Thoa l&ecirc;n da mặt rồi massage nhẹ nh&agrave;ng l&ecirc;n mặt cho đến khi da sạch ho&agrave;n to&agrave;n. Sau đ&oacute; rửa sạch bằng nước ấm. Sản phẩm an to&agrave;n cho da nhạy cảm.</p><p><br></p><p><strong>Kem dưỡng ẩm chống nắng SPF 50+ chứa Axit Hyaluronic - Moisturising Cream SPF50+</strong></p><p><strong>Th&agrave;nh phần&nbsp;</strong></p><p>Aqua, Homosalate, Ethylhexyl salicylate, Dibutyl adipate, Butyl methoxydibenzoylmethane, Glycerin, Titanium dioxide (nano), Methylene bis-benzotriazolyl tetramethylbutylphenol (nano), Caprylyl caprylate/caprate 2,00&hellip;</p><p><strong>C&ocirc;ng dụng:&nbsp;</strong>Gi&uacute;p giữ ẩm cho da, bảo v&ecirc;̣ da dưới tác hại của tia UV.</p><p><strong>Hướng dẫn sử dụng:&nbsp;</strong>Sản phẩm kem dưỡng ẩm kết hợp chống nắng SPF 50+, an to&agrave;n cho da nhạy cảm. Thoa kem đều khắp da mặt, tr&aacute;nh v&ugrave;ng mắt.</p><p><br></p><p><strong>Serum cấp ẩm chứa Axit Hyaluronic 40% - Moisturising Serum</strong></p><p><strong>Th&agrave;nh phần&nbsp;</strong></p><p>Aqua, Glycerin, Dimethicone, Dimethicone crosspolymer, Cyclopentasiloxane, Caprylyl glycol, Tocopheryl acetate, Sodium hyaluronate, Isohexadecane&hellip;</p><p><strong>C&ocirc;ng dụng:&nbsp;</strong>Gi&uacute;p giữ ẩm cho da, l&agrave;m tăng độ đ&agrave;n hồi, giảm nếp nhăn, làm sáng da, giúp da m&ecirc;̀m mịn.</p><p><strong>Hướng dẫn sử dụng:&nbsp;</strong>Thoa đều serum khắp da mặt v&agrave; v&ugrave;ng cổ trước khi sử dụng kem dưỡng ẩm. Sản phẩm an to&agrave;n cho da nhạy cảm.</p><p><strong>Bảo quản:&nbsp;</strong>Nơi kh&ocirc; r&aacute;o tho&aacute;ng m&aacute;t. Lu&ocirc;n đ&oacute;ng nắp sau khi sử dụng. Kh&ocirc;ng bảo quản nơi c&oacute; nhiệt độ qu&aacute; cao hoặc qu&aacute; thấp, tr&aacute;nh &aacute;nh s&aacute;ng trực tiếp.</p><p><br></p><p><strong>Lưu &yacute; an to&agrave;n:&nbsp;</strong>Trong trường hợp phản ứng do qu&aacute; mẫn cảm, ngưng sử dụng v&agrave; hỏi &yacute; kiến dược sĩ hoặc b&aacute;c sĩ. Để xa tầm tay trẻ em. Chỉ d&ugrave;ng ngo&agrave;i da.Lưu &yacute; an to&agrave;n: Trong trường hợp phản ứng do qu&aacute; mẫn cảm, ngưng sử dụng v&agrave; hỏi &yacute; kiến dược sĩ hoặc b&aacute;c sĩ. Để xa tầm tay trẻ em. Chỉ d&ugrave;ng ngo&agrave;i da.</p><p><strong>Sản xuất tại:&nbsp;</strong>Italia (&Yacute;)</p><p><strong>Sản xuất bởi:</strong> UNIFARCO SPA</p><p><strong>Ph&acirc;n phối độc quyền:&nbsp;</strong>C&ocirc;ng ty cổ phần dược phẩm Pharmacity</p><p><strong>Số giấy XNQC:</strong> 1035/2022/XNQC-YTHCM</p>', '845000', '[\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/12\\/1B-sn-phm-size-nh-du-lch-Pharmacist-Formulators-Sa-ra-mt-dng-m--Kem-dng-m-chng-nng---Serum-dng-m-1665079693.webp\",\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/12\\/2B-sn-phm-size-nh-du-lch-Pharmacist-Formulators-Sa-ra-mt-dng-m--Kem-dng-m-chng-nng---Serum-dng-m-1665079693.webp\",\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/12\\/3B-sn-phm-size-nh-du-lch-Pharmacist-Formulators-Sa-ra-mt-dng-m--Kem-dng-m-chng-nng---Serum-dng-m-1665079693.webp\",\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/12\\/4B-sn-phm-size-nh-du-lch-Pharmacist-Formulators-Sa-ra-mt-dng-m--Kem-dng-m-chng-nng---Serum-dng-m-1665079693.webp\",\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/12\\/5B-sn-phm-size-nh-du-lch-Pharmacist-Formulators-Sa-ra-mt-dng-m--Kem-dng-m-chng-nng---Serum-dng-m-1665079693.webp\",\"http:\\/\\/127.0.0.1:8000\\/storage\\/products\\/12\\/6B-sn-phm-size-nh-du-lch-Pharmacist-Formulators-Sa-ra-mt-dng-m--Kem-dng-m-chng-nng---Serum-dng-m-1665079693.webp\"]', '5')
        ");
    }
}
