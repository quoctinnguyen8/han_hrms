-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.4.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for han_hrms
CREATE DATABASE IF NOT EXISTS `han_hrms` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `han_hrms`;

-- Dumping structure for table han_hrms.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính của bảng quản trị viên',
  `username` varchar(30) DEFAULT NULL COMMENT 'Tên đăng nhập của quản trị viên',
  `password` varchar(200) DEFAULT NULL COMMENT 'Mật khẩu của quản trị viên',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table han_hrms.after_universities
CREATE TABLE IF NOT EXISTS `after_universities` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính tự tăng của bảng after_universities',
  `employee_code` varchar(30) NOT NULL COMMENT 'Mã nhân viên làm khóa ngoại',
  `specialized_master` varchar(50) DEFAULT NULL COMMENT 'Chuyên ngành thạc sĩ',
  `training_place_master` varchar(50) DEFAULT NULL COMMENT 'Nơi đào tạo thạc sĩ',
  `degree_year_master` varchar(10) DEFAULT NULL COMMENT 'Năm nhận bằng thạc sĩ',
  `specialized_doctorate` varchar(50) DEFAULT NULL COMMENT 'Chuyên ngành tiến sĩ',
  `training_place_doctorate` varchar(50) DEFAULT NULL COMMENT 'Nơi đào tạo tiến sĩ',
  `degree_year_doctorate` varchar(10) DEFAULT NULL COMMENT 'Năm nhận bằng tiến sĩ',
  PRIMARY KEY (`id`),
  KEY `employee_code` (`employee_code`),
  CONSTRAINT `after_universities_ibfk_1` FOREIGN KEY (`employee_code`) REFERENCES `employees` (`employee_code`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table han_hrms.bonuses
CREATE TABLE IF NOT EXISTS `bonuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính tự tăng của bảng bonuses',
  `employee_code` varchar(30) NOT NULL COMMENT 'Mã nhân viên làm khóa ngoại',
  `bonus_date` date DEFAULT NULL COMMENT 'Ngày thưởng',
  `reason` text DEFAULT NULL COMMENT 'Lý do thưởng',
  `bonus_money` float DEFAULT NULL COMMENT 'Số tiền thưởng',
  PRIMARY KEY (`id`),
  KEY `employee_code` (`employee_code`),
  CONSTRAINT `bonuses_ibfk_1` FOREIGN KEY (`employee_code`) REFERENCES `employees` (`employee_code`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table han_hrms.contracts
CREATE TABLE IF NOT EXISTS `contracts` (
  `contract_code` varchar(30) NOT NULL COMMENT 'Mã hợp đồng duy nhất',
  `contract_type` varchar(50) DEFAULT NULL COMMENT 'Loại hợp đồng',
  `start_date` date DEFAULT NULL COMMENT 'Ngày bắt đầu hợp đồng',
  `end_date` date DEFAULT NULL COMMENT 'Ngày kết thúc hợp đồng',
  `note` text DEFAULT NULL COMMENT 'Ghi chú thêm về hợp đồng',
  `employee_code` varchar(30) DEFAULT NULL COMMENT 'Mã nhân viên',
  `salary_detail_id` int(11) DEFAULT NULL COMMENT 'ID chi tiết lương',
  PRIMARY KEY (`contract_code`),
  KEY `fk_employee_code` (`employee_code`),
  KEY `fk_salary_detail_id` (`salary_detail_id`),
  CONSTRAINT `fk_employee_code` FOREIGN KEY (`employee_code`) REFERENCES `employees` (`employee_code`),
  CONSTRAINT `fk_salary_detail_id` FOREIGN KEY (`salary_detail_id`) REFERENCES `salary_details` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table han_hrms.departments
CREATE TABLE IF NOT EXISTS `departments` (
  `department_code` varchar(30) NOT NULL COMMENT 'Mã phòng ban duy nhất',
  `department_name` varchar(50) NOT NULL COMMENT 'Tên phòng ban',
  `address` varchar(50) DEFAULT NULL COMMENT 'Địa chỉ phòng ban',
  `department_phone_number` varchar(11) DEFAULT NULL COMMENT 'Số điện thoại phòng ban',
  PRIMARY KEY (`department_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table han_hrms.disciplines
CREATE TABLE IF NOT EXISTS `disciplines` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính tự tăng của bảng disciplines',
  `employee_code` varchar(30) NOT NULL COMMENT 'Mã nhân viên làm khóa ngoại',
  `discipline_date` date DEFAULT NULL COMMENT 'Ngày kỷ luật',
  `reason` text DEFAULT NULL COMMENT 'Lý do kỷ luật',
  `discipline_money` float DEFAULT NULL COMMENT 'Số tiền phạt kỷ luật',
  PRIMARY KEY (`id`),
  KEY `employee_code` (`employee_code`),
  CONSTRAINT `disciplines_ibfk_1` FOREIGN KEY (`employee_code`) REFERENCES `employees` (`employee_code`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table han_hrms.education_levels
CREATE TABLE IF NOT EXISTS `education_levels` (
  `education_level_code` varchar(30) NOT NULL COMMENT 'Mã trình độ học vấn duy nhất',
  `education_level_name` text NOT NULL COMMENT 'Tên trình độ học vấn',
  `tier_coefficient` float DEFAULT NULL COMMENT 'Hệ số bậc trình độ học vấn',
  PRIMARY KEY (`education_level_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table han_hrms.education_level_updates
CREATE TABLE IF NOT EXISTS `education_level_updates` (
  `update_code` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính của cập nhật trình độ học vấn',
  `employee_code` varchar(30) NOT NULL COMMENT 'Mã nhân viên làm khóa ngoại',
  `update_day` date NOT NULL COMMENT 'Ngày cập nhật',
  `previous_education_level_code` varchar(30) NOT NULL COMMENT 'Mã trình độ học vấn trước đó',
  `education_level_update_code` varchar(30) NOT NULL COMMENT 'Mã trình độ học vấn sau cập nhật',
  PRIMARY KEY (`update_code`),
  KEY `employee_code` (`employee_code`),
  CONSTRAINT `education_level_updates_ibfk_1` FOREIGN KEY (`employee_code`) REFERENCES `employees` (`employee_code`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table han_hrms.employees
CREATE TABLE IF NOT EXISTS `employees` (
  `employee_code` varchar(30) NOT NULL COMMENT 'Mã nhân viên duy nhất',
  `username` varchar(30) DEFAULT NULL COMMENT 'Tên đăng nhập của nhân viên',
  `password` varchar(200) DEFAULT NULL COMMENT 'Mật khẩu của nhân viên',
  `full_name` varchar(50) DEFAULT NULL COMMENT 'Họ và tên nhân viên',
  `birthday` date DEFAULT NULL COMMENT 'Ngày sinh của nhân viên',
  `hometown` varchar(100) DEFAULT NULL COMMENT 'Quê quán của nhân viên',
  `image` varchar(500) DEFAULT NULL COMMENT 'Đường dẫn ảnh của nhân viên',
  `gender` int(11) DEFAULT NULL COMMENT 'Giới tính của nhân viên (1 là nam, 0 là nữ)',
  `ethnic` varchar(10) DEFAULT NULL COMMENT 'Dân tộc của nhân viên',
  `phone_number` varchar(11) DEFAULT NULL COMMENT 'Số điện thoại của nhân viên',
  `employee_position_code` varchar(30) DEFAULT NULL COMMENT 'Mã chức vụ của nhân viên',
  `status` tinyint(1) NOT NULL COMMENT 'Trạng thái của nhân viên (1 là đang làm việc, 0 là nghỉ việc)',
  `created_by` int(11) DEFAULT NULL COMMENT 'ID của admin tạo nhân viên',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'Thời điểm tạo nhân viên',
  `department_code` varchar(30) DEFAULT NULL COMMENT 'Mã phòng ban của nhân viên',
  `specialized_code` varchar(30) DEFAULT NULL COMMENT 'Mã chuyên ngành của nhân viên',
  `education_level_code` varchar(30) DEFAULT NULL COMMENT 'Mã trình độ học vấn của nhân viên',
  `identity_card` varchar(50) DEFAULT NULL COMMENT 'Số chứng minh nhân dân của nhân viên',
  PRIMARY KEY (`employee_code`),
  KEY `department_code` (`department_code`),
  KEY `education_level_code` (`education_level_code`),
  KEY `employee_position_code` (`employee_position_code`),
  KEY `specialized_code` (`specialized_code`),
  KEY `fk_employees_created_by` (`created_by`),
  CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`department_code`) REFERENCES `departments` (`department_code`) ON DELETE CASCADE,
  CONSTRAINT `employees_ibfk_3` FOREIGN KEY (`education_level_code`) REFERENCES `education_levels` (`education_level_code`),
  CONSTRAINT `employees_ibfk_4` FOREIGN KEY (`employee_position_code`) REFERENCES `employee_positions` (`employee_position_code`),
  CONSTRAINT `employees_ibfk_5` FOREIGN KEY (`specialized_code`) REFERENCES `specialized` (`specialized_code`),
  CONSTRAINT `fk_employees_created_by` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table han_hrms.employee_positions
CREATE TABLE IF NOT EXISTS `employee_positions` (
  `employee_position_code` varchar(30) NOT NULL COMMENT 'Mã chức vụ nhân viên duy nhất',
  `position_name` varchar(50) NOT NULL COMMENT 'Tên chức vụ',
  `hspc` float DEFAULT NULL COMMENT 'Hệ số phụ cấp chức vụ',
  PRIMARY KEY (`employee_position_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table han_hrms.employee_rotations
CREATE TABLE IF NOT EXISTS `employee_rotations` (
  `employee_code` varchar(30) NOT NULL COMMENT 'Mã nhân viên làm khóa ngoại',
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính của luân chuyển nhân viên',
  `rotation_date` date NOT NULL COMMENT 'Ngày luân chuyển',
  `rotation_reason` text DEFAULT NULL COMMENT 'Lý do luân chuyển',
  `department_rotation` varchar(30) DEFAULT NULL COMMENT 'Mã phòng ban chuyển đi',
  `incoming_department` varchar(30) DEFAULT NULL COMMENT 'Mã phòng ban chuyển đến',
  PRIMARY KEY (`id`),
  KEY `employee_code` (`employee_code`),
  CONSTRAINT `employee_rotations_ibfk_1` FOREIGN KEY (`employee_code`) REFERENCES `employees` (`employee_code`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table han_hrms.foreign_languages
CREATE TABLE IF NOT EXISTS `foreign_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính tự tăng của bảng foreign_languages',
  `employee_code` varchar(30) NOT NULL COMMENT 'Mã nhân viên làm khóa ngoại',
  `foreign_language_name` varchar(50) DEFAULT NULL COMMENT 'Tên ngoại ngữ',
  `level` varchar(30) DEFAULT NULL COMMENT 'Trình độ ngoại ngữ',
  PRIMARY KEY (`id`),
  KEY `employee_code` (`employee_code`),
  CONSTRAINT `foreign_languages_ibfk_1` FOREIGN KEY (`employee_code`) REFERENCES `employees` (`employee_code`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table han_hrms.leave_requests
CREATE TABLE IF NOT EXISTS `leave_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_code` varchar(30) NOT NULL COMMENT 'Mã nhân viên tạo đơn nghỉ phép',
  `leave_type` enum('paid','unpaid') NOT NULL COMMENT 'Loại đơn: nghỉ phép/nghỉ không lương',
  `start_date` date NOT NULL COMMENT 'Thời gian nghỉ (ngày bắt đầu)',
  `end_date` date NOT NULL COMMENT 'Thời gian nghỉ (ngày kết thúc)',
  `leave_days` decimal(4,2) NOT NULL COMMENT 'Số ngày nghỉ, dùng để thống kê, không tính thứ 7, chủ nhật',
  `session` enum('morning','afternoon','full_day') DEFAULT 'full_day' COMMENT 'Nghỉ sáng, chiều hay cả ngày',
  `reason` varchar(500) DEFAULT NULL COMMENT 'Lý do nghỉ',
  `status` enum('pending','approved','rejected') DEFAULT 'pending' COMMENT 'Trạng thái của đơn',
  `created_at` datetime DEFAULT current_timestamp() COMMENT 'Ngày tạo đơn',
  `approved_at` datetime DEFAULT NULL COMMENT 'Ngày phê duyệt',
  `approver_id` int(11) DEFAULT NULL COMMENT 'Người phê duyệt',
  PRIMARY KEY (`id`),
  KEY `employee_code` (`employee_code`),
  CONSTRAINT `leave_requests_ibfk_1` FOREIGN KEY (`employee_code`) REFERENCES `employees` (`employee_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table han_hrms.quit_jobs
CREATE TABLE IF NOT EXISTS `quit_jobs` (
  `employee_code` varchar(30) NOT NULL COMMENT 'Mã nhân viên làm khóa ngoại',
  `reason` text DEFAULT NULL COMMENT 'Lý do nghỉ việc',
  `quit_job_date` date NOT NULL COMMENT 'Ngày nghỉ việc',
  PRIMARY KEY (`employee_code`),
  CONSTRAINT `quit_jobs_ibfk_1` FOREIGN KEY (`employee_code`) REFERENCES `employees` (`employee_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table han_hrms.salaries
CREATE TABLE IF NOT EXISTS `salaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính tự tăng của bảng salaries',
  `employee_code` varchar(30) NOT NULL COMMENT 'Mã nhân viên làm khóa ngoại',
  `minimum_salary` float DEFAULT NULL COMMENT 'Lương tối thiểu của nhân viên',
  `salary_coefficient` float DEFAULT NULL COMMENT 'Hệ số lương của nhân viên',
  `social_insurance` float DEFAULT NULL COMMENT 'Bảo hiểm xã hội',
  `health_insurance` float DEFAULT NULL COMMENT 'Bảo hiểm y tế',
  `unemployment_insurance` float DEFAULT NULL COMMENT 'Bảo hiểm thất nghiệp',
  `allowance` float DEFAULT NULL COMMENT 'Phụ cấp của nhân viên',
  `income_tax` float DEFAULT NULL COMMENT 'Thuế thu nhập của nhân viên',
  PRIMARY KEY (`id`),
  KEY `employee_code` (`employee_code`),
  CONSTRAINT `salaries_ibfk_1` FOREIGN KEY (`employee_code`) REFERENCES `employees` (`employee_code`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table han_hrms.salary_details
CREATE TABLE IF NOT EXISTS `salary_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính tự tăng của bảng salary_details',
  `employee_code` varchar(30) NOT NULL COMMENT 'Mã nhân viên làm khóa ngoại',
  `basic_salary` float DEFAULT NULL COMMENT 'Lương cơ bản của nhân viên',
  `social_insurance` float DEFAULT NULL COMMENT 'Bảo hiểm xã hội',
  `health_insurance` float DEFAULT NULL COMMENT 'Bảo hiểm y tế',
  `unemployment_insurance` float DEFAULT NULL COMMENT 'Bảo hiểm thất nghiệp',
  `allowance` float DEFAULT NULL COMMENT 'Phụ cấp của nhân viên',
  `income_tax` float DEFAULT NULL COMMENT 'Thuế thu nhập của nhân viên',
  `bonus_money` float DEFAULT NULL COMMENT 'Tiền thưởng của nhân viên',
  `discipline_money` float DEFAULT NULL COMMENT 'Tiền phạt kỷ luật của nhân viên',
  `pay_day` date DEFAULT NULL COMMENT 'Ngày trả lương',
  `total_salary` float DEFAULT NULL COMMENT 'Tổng lương của nhân viên',
  PRIMARY KEY (`id`),
  KEY `employee_code` (`employee_code`),
  CONSTRAINT `salary_details_ibfk_1` FOREIGN KEY (`employee_code`) REFERENCES `employees` (`employee_code`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table han_hrms.salary_updates
CREATE TABLE IF NOT EXISTS `salary_updates` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính tự tăng của bảng salary_updates',
  `employee_code` varchar(30) NOT NULL COMMENT 'Mã nhân viên làm khóa ngoại',
  `current_salary` float DEFAULT NULL COMMENT 'Lương hiện tại của nhân viên',
  `salary_after_update` float DEFAULT NULL COMMENT 'Lương sau khi cập nhật',
  `salary_coefficient` float DEFAULT NULL COMMENT 'Hệ số lương sau khi cập nhật',
  `social_insurance` float DEFAULT NULL COMMENT 'Bảo hiểm xã hội sau khi cập nhật',
  `health_insurance` float DEFAULT NULL COMMENT 'Bảo hiểm y tế sau khi cập nhật',
  `unemployment_insurance` float DEFAULT NULL COMMENT 'Bảo hiểm thất nghiệp sau khi cập nhật',
  `allowance` float DEFAULT NULL COMMENT 'Phụ cấp sau khi cập nhật',
  `income_tax` float DEFAULT NULL COMMENT 'Thuế thu nhập sau khi cập nhật',
  `update_day` date DEFAULT NULL COMMENT 'Ngày cập nhật lương',
  PRIMARY KEY (`id`),
  KEY `employee_code` (`employee_code`),
  CONSTRAINT `salary_updates_ibfk_1` FOREIGN KEY (`employee_code`) REFERENCES `employees` (`employee_code`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table han_hrms.scientific_research_topics
CREATE TABLE IF NOT EXISTS `scientific_research_topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính tự tăng của bảng scientific_research_topics',
  `employee_code` varchar(30) NOT NULL COMMENT 'Mã nhân viên làm khóa ngoại',
  `scientific_research_topic_name` varchar(200) DEFAULT NULL COMMENT 'Tên đề tài nghiên cứu khoa học',
  `year_of_begin` varchar(10) DEFAULT NULL COMMENT 'Năm bắt đầu nghiên cứu',
  `year_of_complete` varchar(10) DEFAULT NULL COMMENT 'Năm hoàn thành nghiên cứu',
  `level_topic` varchar(50) DEFAULT NULL COMMENT 'Cấp độ của đề tài nghiên cứu',
  `responsibility_in_the_topic` varchar(100) DEFAULT NULL COMMENT 'Trách nhiệm trong đề tài nghiên cứu',
  PRIMARY KEY (`id`),
  KEY `employee_code` (`employee_code`),
  CONSTRAINT `scientific_research_topics_ibfk_1` FOREIGN KEY (`employee_code`) REFERENCES `employees` (`employee_code`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table han_hrms.scientific_works
CREATE TABLE IF NOT EXISTS `scientific_works` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính tự tăng của bảng scientific_works',
  `employee_code` varchar(30) NOT NULL COMMENT 'Mã nhân viên làm khóa ngoại',
  `scientific_works_name` varchar(200) DEFAULT NULL COMMENT 'Tên công trình khoa học',
  `year` varchar(10) DEFAULT NULL COMMENT 'Năm thực hiện công trình khoa học',
  `magazine_name` varchar(200) DEFAULT NULL COMMENT 'Tên tạp chí công bố công trình khoa học',
  PRIMARY KEY (`id`),
  KEY `employee_code` (`employee_code`),
  CONSTRAINT `scientific_works_ibfk_1` FOREIGN KEY (`employee_code`) REFERENCES `employees` (`employee_code`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table han_hrms.specialized
CREATE TABLE IF NOT EXISTS `specialized` (
  `specialized_code` varchar(30) NOT NULL COMMENT 'Mã chuyên ngành duy nhất',
  `specialized_name` varchar(50) DEFAULT NULL COMMENT 'Tên chuyên ngành',
  PRIMARY KEY (`specialized_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table han_hrms.unit_used
CREATE TABLE IF NOT EXISTS `unit_used` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính tự tăng của bảng unit_used',
  `unit_used_name` varchar(200) DEFAULT NULL COMMENT 'Tên đơn vị sử dụng',
  `school_name` varchar(200) DEFAULT NULL COMMENT 'Tên trường',
  `address` varchar(200) DEFAULT NULL COMMENT 'Địa chỉ đơn vị',
  `phone_number` varchar(20) DEFAULT NULL COMMENT 'Số điện thoại đơn vị',
  `email` varchar(200) DEFAULT NULL COMMENT 'Email của đơn vị',
  `salary_increase_period` varchar(10) DEFAULT NULL COMMENT 'Thời gian tăng lương',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table han_hrms.universities
CREATE TABLE IF NOT EXISTS `universities` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính tự tăng của bảng universities',
  `employee_code` varchar(30) NOT NULL COMMENT 'Mã nhân viên làm khóa ngoại',
  `university_name` varchar(50) DEFAULT NULL COMMENT 'Tên trường đại học',
  `training_country` varchar(50) DEFAULT NULL COMMENT 'Quốc gia đào tạo',
  `graduate_year` varchar(10) DEFAULT NULL COMMENT 'Năm tốt nghiệp',
  PRIMARY KEY (`id`),
  KEY `employee_code` (`employee_code`),
  CONSTRAINT `universities_ibfk_1` FOREIGN KEY (`employee_code`) REFERENCES `employees` (`employee_code`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table han_hrms.working_processes
CREATE TABLE IF NOT EXISTS `working_processes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Khóa chính tự tăng của bảng working_processes',
  `employee_code` varchar(30) NOT NULL COMMENT 'Mã nhân viên làm khóa ngoại',
  `work_place` varchar(100) DEFAULT NULL COMMENT 'Nơi làm việc',
  `work_undertake` varchar(200) DEFAULT NULL COMMENT 'Công việc đảm nhận',
  `time` varchar(20) DEFAULT NULL COMMENT 'Thời gian làm việc',
  PRIMARY KEY (`id`),
  KEY `employee_code` (`employee_code`),
  CONSTRAINT `working_processes_ibfk_1` FOREIGN KEY (`employee_code`) REFERENCES `employees` (`employee_code`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
