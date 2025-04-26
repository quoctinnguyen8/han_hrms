-- Thêm cột created_by và created_at vào bảng employees
ALTER TABLE employees
ADD COLUMN created_by INT NULL COMMENT 'ID của admin tạo nhân viên' AFTER status,
ADD COLUMN created_at TIMESTAMP NULL COMMENT 'Thời điểm tạo nhân viên' AFTER created_by;

-- Ràng buộc khóa ngoại với bảng admins
ALTER TABLE employees
ADD CONSTRAINT fk_employees_created_by FOREIGN KEY (created_by)
REFERENCES admins(id) ON DELETE SET NULL;
