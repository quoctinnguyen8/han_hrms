-- Thêm các cột mới vào bảng admins
ALTER TABLE admins
ADD COLUMN is_account_mnt BOOLEAN DEFAULT FALSE COMMENT 'Quyền quản lý tài khoản',
ADD COLUMN is_del_empl BOOLEAN DEFAULT FALSE COMMENT 'Quyền xóa thông tin nhân viên',
ADD COLUMN is_quit_job_mnt BOOLEAN DEFAULT FALSE COMMENT 'Quyền tạo thông tin nghỉ việc',
ADD COLUMN is_leave_mnt BOOLEAN DEFAULT FALSE COMMENT 'Quyền quản lý đơn xin nghỉ phép của nhân viên (chấp nhận, từ chối đơn,..)';