-- Tạo dữ liệu mẫu cho các bảng trong cơ sở dữ liệu nhân sự
-- Giả sử các bảng đã được tạo trước đó và có cấu trúc như đã định nghĩa trong phần 1
-- Thêm dữ liệu vào bảng admins (5 bản ghi)
INSERT INTO admins (username, password) VALUES
('admin1', 'pass123'),
('admin2', 'pass456'),
('manager', 'managerpass'),
('supervisor', 'superpass'),
('staff_admin', 'staffpass');

-- Thêm dữ liệu vào bảng contracts (5 bản ghi)
INSERT INTO contracts (contract_code, contract_type, start_date, end_date, note) VALUES
('HD001', 'Hợp đồng xác định thời hạn 1 năm', '2023-01-01', '2023-12-31', 'Hợp đồng thử việc'),
('HD002', 'Hợp đồng xác định thời hạn 2 năm', '2024-01-01', '2025-12-31', 'Hợp đồng chính thức lần 1'),
('HD003', 'Hợp đồng không xác định thời hạn', '2022-06-15', NULL, 'Nhân viên lâu năm'),
('HD004', 'Hợp đồng thời vụ 3 tháng', '2024-03-01', '2024-05-31', 'Dự án ngắn hạn'),
('HD005', 'Hợp đồng cộng tác viên', '2024-02-01', '2024-07-31', 'CTV Marketing');

-- Thêm dữ liệu vào bảng departments (5 bản ghi)
INSERT INTO departments (department_code, department_name, address, department_phone_number) VALUES
('PB001', 'Phòng Kế toán', 'Tầng 2, Tòa nhà A, 123 Nguyễn Trãi', '0243000111'),
('PB002', 'Phòng Nhân sự', 'Tầng 3, Tòa nhà A, 123 Nguyễn Trãi', '0243000222'),
('PB003', 'Phòng Marketing', 'Tầng 4, Tòa nhà B, 456 Lê Lợi', '0283000333'),
('PB004', 'Phòng Kỹ thuật', 'Tầng 5, Tòa nhà B, 456 Lê Lợi', '0283000444'),
('PB005', 'Ban Giám đốc', 'Tầng 10, Tòa nhà A, 123 Nguyễn Trãi', '0243000555');

-- Thêm dữ liệu vào bảng education_levels (5 bản ghi)
INSERT INTO education_levels (education_level_code, education_level_name, tier_coefficient) VALUES
('TDHV001', 'Trung cấp', 1.86),
('TDHV002', 'Cao đẳng', 2.10),
('TDHV003', 'Đại học', 2.34),
('TDHV004', 'Thạc sĩ', 3.00),
('TDHV005', 'Tiến sĩ', 3.50);

-- Thêm dữ liệu vào bảng specialized (5 bản ghi)
INSERT INTO specialized (specialized_code, specialized_name) VALUES
('CN001', 'Kế toán doanh nghiệp'),
('CN002', 'Quản trị nhân lực'),
('CN003', 'Marketing Digital'),
('CN004', 'Phát triển phần mềm'),
('CN005', 'Quản trị kinh doanh');

-- Thêm dữ liệu vào bảng employee_positions (5 bản ghi)
INSERT INTO employee_positions (employee_position_code, position_name, hspc) VALUES
('CV001', 'Nhân viên', 0.2),
('CV002', 'Chuyên viên', 0.3),
('CV003', 'Trưởng nhóm', 0.4),
('CV004', 'Phó phòng', 0.5),
('CV005', 'Trưởng phòng', 0.6);

-- Thêm dữ liệu vào bảng unit_used (5 bản ghi)
INSERT INTO unit_used (unit_used_name, school_name, address, phone_number, email, salary_increase_period) VALUES
('Công ty TNHH Giải Pháp ABC', 'Trường Đại học Bách Khoa Hà Nội', 'Số 1 Đại Cồ Việt, Hà Nội', '02438680001', 'contact@abc.com', '2 năm'),
('Tập đoàn XYZ Corp', 'Trường Đại học Kinh Tế Quốc Dân', '207 Giải Phóng, Hà Nội', '02436280280', 'hr@xyz.com', '3 năm'),
('Công ty Cổ phần Sáng Tạo Mới', 'Trường Đại học FPT', 'Khu CNC Hòa Lạc, Thạch Thất, Hà Nội', '02473001866', 'recruit@sangtaomoi.vn', '2.5 năm'),
('Ngân hàng TMCP Hàng Hải', 'Học viện Ngân hàng', '12 Chùa Bộc, Đống Đa, Hà Nội', '1800599999', 'info@msb.com.vn', '3 năm'),
('Công ty Dịch vụ Logistech', 'Trường Đại học Giao thông Vận tải', 'Số 3 Cầu Giấy, Láng Thượng, Hà Nội', '02437663311', 'support@logistech.co', '2 năm');

-- Thêm dữ liệu vào bảng employees (5 bản ghi)
-- Giả sử NV001, NV002, NV003 đang làm việc; NV004, NV005 đã nghỉ việc (sẽ có bản ghi trong quit_jobs)
-- Giả sử NV001 được luân chuyển sang PB002, NV002 có cập nhật trình độ học vấn lên TDHV004
INSERT INTO employees (employee_code, username, password, full_name, birthday, hometown, image, gender, ethnic, phone_number, employee_position_code, status, department_code, contract_code, specialized_code, education_level_code, identity_card) VALUES
('NV001', 'nguyenvana', 'passnv1', 'Nguyễn Văn An', '1990-03-15', 'Hà Nội', 'images/nv001.jpg', 1, 'Kinh', '0912345678', 'CV002', 1, 'PB002', 'HD002', 'CN001', 'TDHV003', '001090000111'), -- Luân chuyển sang PB002
('NV002', 'tranvanbinh', 'passnv2', 'Trần Thị Bình', '1992-07-20', 'Hải Phòng', 'images/nv002.jpg', 0, 'Kinh', '0987654321', 'CV003', 1, 'PB003', 'HD003', 'CN003', 'TDHV004', '002092000222'), -- Cập nhật lên TDHV004
('NV003', 'lethicam', 'passnv3', 'Lê Thị Cẩm', '1988-11-05', 'Đà Nẵng', 'images/nv003.jpg', 0, 'Kinh', '0905123789', 'CV005', 1, 'PB004', 'HD003', 'CN004', 'TDHV005', '003088000333'),
('NV004', 'phamvandung', 'passnv4', 'Phạm Văn Dũng', '1995-01-25', 'Nghệ An', 'images/nv004.jpg', 1, 'Kinh', '0978123456', 'CV001', 0, 'PB001', 'HD001', 'CN001', 'TDHV002', '004095000444'), -- Nghỉ việc
('NV005', 'hoangthie', 'passnv5', 'Hoàng Thị E', '1993-09-10', 'TP. Hồ Chí Minh', 'images/nv005.jpg', 0, 'Kinh', '0938555666', 'CV002', 0, 'PB005', 'HD002', 'CN005', 'TDHV003', '005093000555'); -- Nghỉ việc

-- Thêm dữ liệu vào bảng after_universities (5 bản ghi, 1 cho mỗi nhân viên)
INSERT INTO after_universities (employee_code, specialized_master, training_place_master, degree_year_master, specialized_doctorate, training_place_doctorate, degree_year_doctorate) VALUES
('NV001', 'Thạc sĩ Kế toán', 'Đại học Kinh tế Quốc Dân', '2018', NULL, NULL, NULL),
('NV002', 'Thạc sĩ Marketing', 'Đại học RMIT Việt Nam', '2020', NULL, NULL, NULL),
('NV003', 'Tiến sĩ Công nghệ Thông tin', 'Đại học Bách Khoa Hà Nội', '2016', 'Khoa học Máy tính', 'Đại học Stanford', '2020'),
('NV004', NULL, NULL, NULL, NULL, NULL, NULL), -- Không có bằng sau đại học
('NV005', 'Thạc sĩ Quản trị Kinh doanh', 'Đại học Fulbright Việt Nam', '2019', NULL, NULL, NULL);

-- Thêm dữ liệu vào bảng bonuses (5 bản ghi)
INSERT INTO bonuses (employee_code, bonus_date, reason, bonus_money) VALUES
('NV001', '2024-12-20', 'Hoàn thành xuất sắc dự án Quý 4', 5000000),
('NV002', '2024-11-15', 'Sáng kiến cải tiến quy trình', 3000000),
('NV003', '2025-01-05', 'Đạt danh hiệu nhân viên của năm', 10000000),
('NV001', '2025-03-10', 'Vượt chỉ tiêu doanh số tháng 2', 4000000),
('NV002', '2025-04-01', 'Hỗ trợ thành công sự kiện công ty', 2000000);

-- Thêm dữ liệu vào bảng disciplines (5 bản ghi)
INSERT INTO disciplines (employee_code, discipline_date, reason, discipline_money) VALUES
('NV004', '2023-10-05', 'Đi làm muộn nhiều lần', 500000),
('NV005', '2024-01-15', 'Không hoàn thành công việc đúng hạn', 1000000),
('NV001', '2024-05-20', 'Vi phạm nội quy về bảo mật thông tin', 2000000),
('NV004', '2023-11-22', 'Gây thất thoát tài sản nhỏ', 700000),
('NV002', '2025-02-10', 'Sử dụng tài sản công ty vào việc riêng', 300000);

-- Thêm dữ liệu vào bảng education_level_updates (5 bản ghi)
-- update_code là AUTO_INCREMENT
INSERT INTO education_level_updates (employee_code, update_day, previous_education_level_code, education_level_update_code) VALUES
('NV002', '2023-08-15', 'TDHV003', 'TDHV004'), -- NV002 cập nhật từ ĐH lên Thạc sĩ
('NV001', '2022-05-20', 'TDHV002', 'TDHV003'), -- NV001 cập nhật từ CĐ lên ĐH
('NV003', '2020-01-10', 'TDHV004', 'TDHV005'), -- NV003 cập nhật từ ThS lên TS
('NV005', '2021-06-01', 'TDHV002', 'TDHV003'), -- NV005 cập nhật từ CĐ lên ĐH
('NV001', '2017-09-01', 'TDHV001', 'TDHV002'); -- NV001 cập nhật từ TC lên CĐ

-- Thêm dữ liệu vào bảng employee_rotations (5 bản ghi)
-- id là AUTO_INCREMENT
INSERT INTO employee_rotations (employee_code, rotation_date, rotation_reason, department_rotation, incoming_department) VALUES
('NV001', '2024-06-01', 'Điều chuyển công tác theo yêu cầu', 'PB001', 'PB002'), -- NV001 chuyển từ Kế toán sang Nhân sự
('NV002', '2023-12-01', 'Phát triển chuyên môn mới', 'PB002', 'PB003'), -- NV002 chuyển từ Nhân sự sang Marketing
('NV003', '2022-10-10', 'Bổ nhiệm vị trí quản lý', 'PB004', 'PB005'), -- NV003 chuyển từ Kỹ thuật sang Ban Giám đốc (ví dụ)
('NV001', '2025-01-15', 'Luân chuyển định kỳ', 'PB002', 'PB004'), -- NV001 lại chuyển từ Nhân sự sang Kỹ thuật
('NV005', '2023-03-01', 'Yêu cầu cá nhân', 'PB003', 'PB005'); -- NV005 chuyển từ Marketing sang Ban Giám đốc

-- Thêm dữ liệu vào bảng foreign_languages (5 bản ghi)
INSERT INTO foreign_languages (employee_code, foreign_language_name, level) VALUES
('NV001', 'Tiếng Anh', 'IELTS 7.0'),
('NV002', 'Tiếng Nhật', 'JLPT N2'),
('NV003', 'Tiếng Anh', 'TOEFL iBT 100'),
('NV003', 'Tiếng Pháp', 'DELF B2'),
('NV005', 'Tiếng Trung', 'HSK 5');

-- Thêm dữ liệu vào bảng quit_jobs (5 bản ghi)
-- employee_code là PK, giả sử NV004, NV005 đã nghỉ. Thêm 3 người nữa nghỉ việc.
-- Cần đảm bảo các employee_code này tồn tại và status của họ trong bảng employees là 0.
-- Để đơn giản, ta sẽ cho NV004, NV005 nghỉ như đã set ở bảng employees.
-- Thêm 3 nhân viên mới (NV006, NV007, NV008) chỉ để phục vụ bảng này, hoặc chấp nhận chỉ có 2 bản ghi cho NV004, NV005.
-- Theo yêu cầu "5 bản ghi mỗi bảng", ta sẽ tạo thêm 3 nhân viên (NV006, NV007, NV008) và cho họ nghỉ việc.
-- Trước tiên, thêm 3 nhân viên này vào bảng employees với status = 0.
INSERT INTO employees (employee_code, username, password, full_name, birthday, hometown, image, gender, ethnic, phone_number, employee_position_code, status, department_code, contract_code, specialized_code, education_level_code, identity_card) VALUES
('NV006', 'nguyenvanf', 'passnv6', 'Nguyễn Văn F', '1991-02-11', 'Bình Dương', 'images/nv006.jpg', 1, 'Kinh', '0912345006', 'CV001', 0, 'PB001', 'HD001', 'CN001', 'TDHV003', '006091000666'),
('NV007', 'tranthig', 'passnv7', 'Trần Thị G', '1994-04-14', 'Long An', 'images/nv007.jpg', 0, 'Kinh', '0987654007', 'CV002', 0, 'PB002', 'HD002', 'CN002', 'TDHV003', '007094000777'),
('NV008', 'levanh', 'passnv8', 'Lê Văn H', '1989-06-16', 'Cần Thơ', 'images/nv008.jpg', 1, 'Kinh', '0905123008', 'CV003', 0, 'PB003', 'HD004', 'CN003', 'TDHV004', '008089000888');

INSERT INTO quit_jobs (employee_code, reason, quit_job_date) VALUES
('NV004', 'Chuyển công tác sang công ty khác', '2024-02-28'),
('NV005', 'Lý do cá nhân, gia đình', '2024-05-10'),
('NV006', 'Không phù hợp với văn hóa công ty', '2023-12-31'),
('NV007', 'Tìm kiếm cơ hội phát triển tốt hơn', '2024-03-15'),
('NV008', 'Nghỉ hưu sớm', '2025-01-01');

-- Thêm dữ liệu vào bảng salaries (5 bản ghi, 1 cho mỗi nhân viên đang làm việc NV001, NV002, NV003 và 2 nhân viên đã nghỉ NV004, NV005)
-- Thông thường bảng lương chỉ lưu cho nhân viên hiện tại hoặc có cơ chế lưu lịch sử.
-- Để đủ 5 bản ghi, ta sẽ thêm cho cả 5 nhân viên đầu tiên.
INSERT INTO salaries (employee_code, minimum_salary, salary_coefficient, social_insurance, health_insurance, unemployment_insurance, allowance, income_tax) VALUES
('NV001', 4680000, 2.67, 374400, 70200, 46800, 1500000, 500000), -- Giả sử hệ số lương của NV001 là 2.67
('NV002', 4680000, 3.00, 374400, 70200, 46800, 2000000, 700000), -- Giả sử hệ số lương của NV002 là 3.00 (Thạc sĩ)
('NV003', 4680000, 3.50, 374400, 70200, 46800, 3000000, 1000000),-- Giả sử hệ số lương của NV003 là 3.50 (Tiến sĩ)
('NV004', 4680000, 2.10, 374400, 70200, 46800, 500000, 100000),  -- Lương NV004 trước khi nghỉ
('NV005', 4680000, 2.34, 374400, 70200, 46800, 1000000, 300000); -- Lương NV005 trước khi nghỉ

-- Thêm dữ liệu vào bảng salary_details (5 bản ghi, chi tiết lương cho 1 tháng của 5 nhân viên)
INSERT INTO salary_details (employee_code, basic_salary, social_insurance, health_insurance, unemployment_insurance, allowance, income_tax, bonus_money, discipline_money, pay_day, total_salary) VALUES
('NV001', 12495600, 999648, 187434, 124956, 1500000, 500000, 5000000, 0, '2025-01-10', 17183562), -- Lương tháng 12/2024 (có bonus)
('NV002', 14040000, 1123200, 210600, 140400, 2000000, 700000, 0, 0, '2025-01-10', 13865800),
('NV003', 16380000, 1310400, 245700, 163800, 3000000, 1000000, 0, 0, '2025-01-10', 16660100),
('NV004', 9828000, 786240, 147420, 98280, 500000, 100000, 0, 500000, '2023-11-10', 8706060), -- Lương tháng 10/2023 (có phạt)
('NV005', 10951200, 876096, 164268, 109512, 1000000, 300000, 0, 0, '2024-02-10', 10501324);

-- Thêm dữ liệu vào bảng salary_updates (5 bản ghi)
INSERT INTO salary_updates (employee_code, current_salary, salary_after_update, salary_coefficient, social_insurance, health_insurance, unemployment_insurance, allowance, income_tax, update_day) VALUES
('NV001', 10951200, 12495600, 2.67, 999648, 187434, 124956, 1500000, 500000, '2024-01-01'), -- NV001 tăng lương
('NV002', 12000000, 14040000, 3.00, 1123200, 210600, 140400, 2000000, 700000, '2023-09-01'), -- NV002 tăng lương do cập nhật trình độ
('NV003', 15000000, 16380000, 3.50, 1310400, 245700, 163800, 3000000, 1000000, '2022-11-01'), -- NV003 tăng lương
('NV001', 9000000, 10951200, 2.34, 876096, 164268, 109512, 1200000, 400000, '2023-01-01'), -- Lần tăng lương trước của NV001
('NV005', 9500000, 10951200, 2.34, 876096, 164268, 109512, 1000000, 300000, '2023-07-01'); -- NV005 tăng lương

-- Thêm dữ liệu vào bảng scientific_research_topics (5 bản ghi)
INSERT INTO scientific_research_topics (employee_code, scientific_research_topic_name, year_of_begin, year_of_complete, level_topic, responsibility_in_the_topic) VALUES
('NV003', 'Ứng dụng AI trong tối ưu hóa chuỗi cung ứng', '2021', '2023', 'Cấp Bộ', 'Chủ nhiệm đề tài'),
('NV001', 'Phân tích rủi ro tín dụng cho SME', '2022', '2023', 'Cấp Trường', 'Thành viên'),
('NV002', 'Nghiên cứu hành vi người tiêu dùng Gen Z', '2023', '2024', 'Cấp Công ty', 'Chủ nhiệm đề tài'),
('NV003', 'Phát triển thuật toán học máy cho xe tự hành', '2019', '2021', 'Cấp Nhà nước', 'Thư ký khoa học'),
('NV005', 'Giải pháp nâng cao hiệu quả quản trị doanh nghiệp vừa và nhỏ', '2020', '2022', 'Cấp Trường', 'Thành viên');

-- Thêm dữ liệu vào bảng scientific_works (5 bản ghi)
INSERT INTO scientific_works (employee_code, scientific_works_name, year, magazine_name) VALUES
('NV003', 'A Novel Approach for Supply Chain Optimization using Deep Learning', '2023', 'IEEE Transactions on Engineering Management'),
('NV001', 'Credit Risk Assessment Models for Small and Medium Enterprises in Vietnam', '2023', 'Tạp chí Khoa học Kinh tế'),
('NV002', 'Understanding Gen Z Consumer Behavior in the Digital Age', '2024', 'Journal of Marketing Research'),
('NV003', 'Machine Learning Algorithms for Autonomous Vehicle Navigation: A Review', '2021', 'AI Communications'),
('NV005', 'Effective Governance Solutions for SMEs: Case Studies from Vietnam', '2022', 'Tạp chí Phát triển Kinh tế');

-- Thêm dữ liệu vào bảng universities (5 bản ghi, 1 cho mỗi nhân viên)
INSERT INTO universities (employee_code, university_name, training_country, graduate_year) VALUES
('NV001', 'Cao đẳng Kinh tế Kỹ thuật Thương mại', 'Việt Nam', '2011'), -- Sau đó học lên ĐH, ThS
('NV002', 'Đại học Ngoại thương', 'Việt Nam', '2014'),
('NV003', 'Đại học Bách Khoa TP.HCM', 'Việt Nam', '2010'),
('NV004', 'Cao đẳng Công nghiệp Hà Nội', 'Việt Nam', '2016'),
('NV005', 'Đại học Kinh tế TP.HCM', 'Việt Nam', '2015');

-- Thêm dữ liệu vào bảng working_processes (5 bản ghi)
INSERT INTO working_processes (employee_code, work_place, work_undertake, time) VALUES
('NV001', 'Công ty TNHH Kiểm toán ABC (Trước đây)', 'Trợ lý kiểm toán', '2011-06 - 2013-12'),
('NV002', 'Công ty Quảng cáo Sáng Tạo XYZ (Trước đây)', 'Chuyên viên Content', '2014-08 - 2016-12'),
('NV003', 'Viện Nghiên cứu Công nghệ DEF (Trước đây)', 'Nghiên cứu viên', '2010-09 - 2014-05'),
('NV004', 'Xưởng cơ khí Minh Phát (Trước đây)', 'Nhân viên kỹ thuật', '2016-07 - 2018-10'),
('NV005', 'Ngân hàng Á Châu - Chi nhánh Q1 (Trước đây)', 'Giao dịch viên', '2015-10 - 2017-12');