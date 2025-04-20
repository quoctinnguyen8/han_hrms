function showTabWithError(selector) {
    const firstInvalidElement = document.querySelector(selector);
    if (!firstInvalidElement) return null;

    const tabPane = firstInvalidElement.closest(".tab-pane");
    if (!tabPane) return firstInvalidElement;

    const tabPaneId = tabPane.getAttribute("id");
    if (!tabPaneId) return firstInvalidElement;

    const tabTrigger = document.querySelector(
        `.nav-tabs .nav-link[data-bs-target="#${tabPaneId}"]`
    );
    if (!tabTrigger) return firstInvalidElement;

    // Kiểm tra xem tab đã active chưa trước khi show
    if (!tabTrigger.classList.contains("active")) {
        const tab = new bootstrap.Tab(tabTrigger);
        // Nghe sự kiện sau khi tab đã được hiển thị hoàn toàn
        tabTrigger.addEventListener(
            "shown.bs.tab",
            () => {
                // Chỉ focus sau khi tab đã hiển thị
                firstInvalidElement.focus();
            },
            { once: true }
        ); // Chỉ chạy listener một lần
        tab.show();
    } else {
        // Nếu tab đã active, focus ngay lập tức
        firstInvalidElement.focus();
    }

    return firstInvalidElement;
}

// 1. Xử lý lỗi validation từ Server (sau khi reload trang)
document.addEventListener("DOMContentLoaded", function () {
    let err = document.querySelector(".js-admin-error"); 
    let serverErrorField = document.querySelector(".is-invalid");

    if (err || serverErrorField) {
        // Tìm phần tử đầu tiên có class 'is-invalid'
        showTabWithError(".is-invalid");
    }
});

// 2. Nếu còn lỗi thì không cho submit
const form = document.getElementById("fCreateEmployee");
const createButton = document.getElementById("btnCreateEmployee");

createButton.addEventListener("click", function (event) {
    event.preventDefault(); 
    
    // Reset previous validation state
    const invalidInputs = form.querySelectorAll('.is-invalid');
    invalidInputs.forEach(input => {
        input.classList.remove('is-invalid');
        const feedbackElement = input.nextElementSibling;
        if (feedbackElement && feedbackElement.classList.contains('invalid-feedback')) {
            feedbackElement.textContent = '';
        }
    });
    
    let hasErrors = false;
    
    // Required fields validation
    const requiredFields = [
        'employee_code', 'full_name', 'birthday', 'hometown', 'phone_number',
        'gender', 'ethnic', 'department_code', 'employee_position_code',
        'contract_code', 'specialized_code', 'education_level_code', 'status',
        'contract_type', 'start_date', 'end_date', 'basic_salary', 'social_insurance',
        'health_insurance', 'unemployment_insurance', 'allowance', 'income_tax',
        'pay_day',
        'password', 'password_confirmation'
    ];
    
    requiredFields.forEach(field => {
        const input = form.querySelector(`[name="${field}"]`);
        if (input && !input.value.trim()) {
            markInvalid(input, 'Trường này là bắt buộc');
            hasErrors = true;
        }
    });
    
    // Password validation
    const password = form.querySelector('[name="password"]');
    const passwordConfirm = form.querySelector('[name="password_confirmation"]');
    
    if (password && password.value) {
        if (password.value.length < 8) {
            markInvalid(password, 'Mật khẩu phải có ít nhất 8 ký tự');
            hasErrors = true;
        } else if (passwordConfirm && password.value !== passwordConfirm.value) {
            markInvalid(passwordConfirm, 'Mật khẩu xác nhận không khớp');
            hasErrors = true;
        }
    }
    
    // Date validations
    const startDate = form.querySelector('[name="start_date"]');
    const endDate = form.querySelector('[name="end_date"]');
    const payDay = form.querySelector('[name="pay_day"]');
    
    if (startDate && endDate && startDate.value && endDate.value) {
        const start = new Date(startDate.value);
        const end = new Date(endDate.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        
        if (start > end) {
            markInvalid(startDate, 'Ngày bắt đầu phải trước hoặc bằng ngày kết thúc');
            hasErrors = true;
        }
        
        if (start < today) {
            markInvalid(startDate, 'Ngày bắt đầu phải sau hoặc bằng ngày hiện tại');
            hasErrors = true;
        }
        
        if (end < today) {
            markInvalid(endDate, 'Ngày kết thúc phải sau hoặc bằng ngày hiện tại');
            hasErrors = true;
        }
        
        if (payDay && payDay.value) {
            const pay = new Date(payDay.value);
            if (pay < start) {
                markInvalid(payDay, 'Ngày trả lương phải sau hoặc bằng ngày bắt đầu');
                hasErrors = true;
            }
        }
    }
    
    // Numeric validations
    const numericFields = [
        'basic_salary', 'social_insurance', 'health_insurance', 
        'unemployment_insurance', 'allowance', 'income_tax'
    ];
    
    numericFields.forEach(field => {
        const input = form.querySelector(`[name="${field}"]`);
        if (input && input.value) {
            const value = parseFloat(input.value);
            if (isNaN(value) || value < 1 || value > 99999999999) {
                markInvalid(input, 'Giá trị phải là số từ 1 đến 99999999999');
                hasErrors = true;
            }
        }
    });
    
    // Image validation
    const imageInput = form.querySelector('[name="image"]');
    if (imageInput && imageInput.files.length > 0) {
        const file = imageInput.files[0];
        const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        const maxSize = 2 * 1024 * 1024; // 2MB
        
        if (!validTypes.includes(file.type)) {
            markInvalid(imageInput, 'Ảnh phải là định dạng: jpeg, png, jpg, gif');
            hasErrors = true;
        } else if (file.size > maxSize) {
            markInvalid(imageInput, 'Ảnh không được vượt quá 2MB');
            hasErrors = true;
        }
    }
    
    // Hiển thị tab có lỗi
    if (hasErrors) {
        showTabWithError('.is-invalid');
        return;
    }
    
    // Ok hết thì submit form
    form.submit();
    
    // hàm hỗ trợ đánh dấu input không hợp lệ
    function markInvalid(input, message) {
        input.classList.add('is-invalid');
        let feedbackElement = input.nextElementSibling;
        if (!feedbackElement || !feedbackElement.classList.contains('invalid-feedback')) {
            feedbackElement = document.createElement('div');
            feedbackElement.classList.add('invalid-feedback');
            input.parentNode.insertBefore(feedbackElement, input.nextSibling);
        }
        feedbackElement.textContent = message;
    }
});
