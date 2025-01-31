<?php

declare(strict_types=1);

return [
    'accepted'             => 'Trường :attribute phải được chấp nhận.',
    'accepted_if'          => 'Trường :attribute phải được chấp nhận khi :other là :value.',
    'active_url'           => 'Trường :attribute không phải là một URL hợp lệ.',
    'after'                => 'Trường :attribute phải là một ngày sau ngày :date.',
    'after_or_equal'       => 'Trường :attribute phải là thời gian bắt đầu sau hoặc đúng bằng :date.',
    'alpha'                => 'Trường :attribute chỉ có thể chứa các chữ cái.',
    'alpha_dash'           => 'Trường :attribute chỉ có thể chứa chữ cái, số và dấu gạch ngang.',
    'alpha_num'            => 'Trường :attribute chỉ có thể chứa chữ cái và số.',
    'array'                => 'Trường :attribute phải là dạng mảng.',
    'ascii'                => 'Trường :attribute chỉ được chứa các ký tự chữ số và ký hiệu một byte.',
    'before'               => 'Trường :attribute phải là một ngày trước ngày :date.',
    'before_or_equal'      => 'Trường :attribute phải là thời gian bắt đầu trước hoặc đúng bằng :date.',
    'between'              => [
        'array'   => 'Trường :attribute phải có từ :min - :max phần tử.',
        'file'    => 'Dung lượng tập tin trong trường :attribute phải từ :min - :max kB.',
        'numeric' => 'Trường :attribute phải nằm trong khoảng :min - :max.',
        'string'  => 'Trường :attribute phải từ :min - :max kí tự.',
    ],
    'boolean'              => 'Trường :attribute phải là true hoặc false.',
    'can'                  => 'Trường :attribute chứa một giá trị trái phép.',
    'confirmed'            => 'Giá trị xác nhận trong trường :attribute không khớp.',
    'current_password'     => 'Mật khẩu không đúng.',
    'date'                 => 'Trường :attribute không phải là định dạng của ngày-tháng.',
    'date_equals'          => 'Trường :attribute phải là một ngày bằng với :date.',
    'date_format'          => 'Trường :attribute không giống với định dạng :format.',
    'decimal'              => 'Trường :attribute phải có :decimal chữ số thập phân.',
    'declined'             => 'Trường :attribute phải bị từ chối.',
    'declined_if'          => 'Trường :attribute phải bị từ chối khi :other là :value.',
    'different'            => 'Trường :attribute và :other phải khác nhau.',
    'digits'               => 'Độ dài của trường :attribute phải gồm :digits chữ số.',
    'digits_between'       => 'Độ dài của trường :attribute phải nằm trong khoảng :min - :max chữ số.',
    'dimensions'           => 'Trường :attribute có kích thước không hợp lệ.',
    'distinct'             => 'Trường :attribute có giá trị trùng lặp.',
    'doesnt_end_with'      => 'Trường :attribute không được kết thúc bằng một trong những điều kiện sau: :values.',
    'doesnt_start_with'    => 'Trường :attribute không được bắt đầu bằng một trong những điều sau: :values.',
    'email'                => 'Trường :attribute phải là một địa chỉ email hợp lệ.',
    'ends_with'            => 'Trường :attribute phải kết thúc bằng một trong những giá trị sau: :values',
    'enum'                 => 'Giá trị đã chọn trong trường :attribute không hợp lệ.',
    'exists'               => 'Giá trị đã chọn trong trường :attribute không hợp lệ.',
    'extensions'           => 'Trường :attribute phải có một trong các phần mở rộng sau: :values.',
    'file'                 => 'Trường :attribute phải là một tệp tin.',
    'filled'               => 'Trường :attribute không được bỏ trống.',
    'gt'                   => [
        'array'   => 'Mảng :attribute phải có nhiều hơn :value phần tử.',
        'file'    => 'Dung lượng trường :attribute phải lớn hơn :value kilobytes.',
        'numeric' => 'Giá trị trường :attribute phải lớn hơn :value.',
        'string'  => 'Độ dài trường :attribute phải nhiều hơn :value kí tự.',
    ],
    'gte'                  => [
        'array'   => 'Mảng :attribute phải có ít nhất :value phần tử.',
        'file'    => 'Dung lượng trường :attribute phải lớn hơn hoặc bằng :value kilobytes.',
        'numeric' => 'Giá trị trường :attribute phải lớn hơn hoặc bằng :value.',
        'string'  => 'Độ dài trường :attribute phải lớn hơn hoặc bằng :value kí tự.',
    ],
    'hex_color'            => 'Trường :attribute phải là một mã màu hex hợp lệ.',
    'image'                => 'Trường :attribute phải là định dạng hình ảnh.',
    'in'                   => 'Giá trị đã chọn trong trường :attribute không hợp lệ.',
    'in_array'             => 'Trường :attribute phải thuộc tập cho phép: :other.',
    'integer'              => 'Trường :attribute phải là một số nguyên.',
    'ip'                   => 'Trường :attribute phải là một địa chỉ IP.',
    'ipv4'                 => 'Trường :attribute phải là một địa chỉ IPv4.',
    'ipv6'                 => 'Trường :attribute phải là một địa chỉ IPv6.',
    'json'                 => 'Trường :attribute phải là một chuỗi JSON.',
    'lowercase'            => 'Trường :attribute phải là chữ thường.',
    'lt'                   => [
        'array'   => 'Mảng :attribute phải có ít hơn :value phần tử.',
        'file'    => 'Dung lượng trường :attribute phải nhỏ hơn :value kilobytes.',
        'numeric' => 'Giá trị trường :attribute phải nhỏ hơn :value.',
        'string'  => 'Độ dài trường :attribute phải nhỏ hơn :value kí tự.',
    ],
    'lte'                  => [
        'array'   => 'Mảng :attribute không được có nhiều hơn :value phần tử.',
        'file'    => 'Dung lượng trường :attribute phải nhỏ hơn hoặc bằng :value kilobytes.',
        'numeric' => 'Giá trị trường :attribute phải nhỏ hơn hoặc bằng :value.',
        'string'  => 'Độ dài trường :attribute phải nhỏ hơn hoặc bằng :value kí tự.',
    ],
    'mac_address'          => 'Trường :attribute phải là một địa chỉ MAC hợp lệ.',
    'max'                  => [
        'array'   => 'Trường :attribute không được lớn hơn :max phần tử.',
        'file'    => 'Dung lượng tập tin trong trường :attribute không được lớn hơn :max kB.',
        'numeric' => 'Trường :attribute không được lớn hơn :max.',
        'string'  => 'Trường :attribute không được lớn hơn :max kí tự.',
    ],
    'max_digits'           => 'Trường :attribute không được lớn hơn :max kí tự.',
    'mimes'                => 'Trường :attribute phải là một tập tin có định dạng: :values.',
    'mimetypes'            => 'Trường :attribute phải là một tập tin có định dạng: :values.',
    'min'                  => [
        'array'   => 'Trường :attribute phải có tối thiểu :min phần tử.',
        'file'    => 'Dung lượng tập tin trong trường :attribute phải tối thiểu :min kB.',
        'numeric' => 'Trường :attribute phải tối thiểu là :min.',
        'string'  => 'Trường :attribute phải có tối thiểu :min kí tự.',
    ],
    'min_digits'           => 'Trường :attribute phải có tối thiểu :min chữ số.',
    'missing'              => 'Trường :attribute phải bị thiếu.',
    'missing_if'           => 'Trường :attribute phải bị thiếu khi :other là :value.',
    'missing_unless'       => 'Trường :attribute phải bị thiếu trừ khi :other là :value.',
    'missing_with'         => 'Trường :attribute phải bị thiếu khi có :values.',
    'missing_with_all'     => 'Trường :attribute phải bị thiếu khi có :values trường.',
    'multiple_of'          => 'Trường :attribute phải là bội số của :value',
    'not_in'               => 'Giá trị đã chọn trong trường :attribute không hợp lệ.',
    'not_regex'            => 'Trường :attribute có định dạng không hợp lệ.',
    'numeric'              => 'Trường :attribute phải là một số.',
    'password'             => [
        'letters'       => 'Trường :attribute phải chứa ít nhất một chữ cái.',
        'mixed'         => 'Trường :attribute phải chứa ít nhất một chữ cái in hoa và một chữ cái thường.',
        'numbers'       => 'Trường :attribute phải chứa ít nhất một số.',
        'symbols'       => 'Trường :attribute phải chứa ít nhất một ký tự đặc biệt.',
        'uncompromised' => 'Trường được nhận :attribute đã xuất hiện trong một vụ rò rỉ dữ liệu. Vui lòng chọn một :attribute khác.',
    ],
    'present'              => 'Trường :attribute phải được cung cấp.',
    'present_if'           => 'Trường :attribute phải có mặt khi :other là :value.',
    'present_unless'       => 'Trường :attribute phải có mặt trừ khi :other là :value.',
    'present_with'         => 'Trường :attribute phải có mặt khi có :values.',
    'present_with_all'     => 'Trường :attribute phải có mặt khi có :values.',
    'prohibited'           => 'Trường :attribute bị cấm.',
    'prohibited_if'        => 'Trường :attribute bị cấm khi :other là :value.',
    'prohibited_unless'    => 'Trường :attribute bị cấm trừ khi :other là một trong :values.',
    'prohibits'            => 'Trường :attribute cấm :other từ thời điểm hiện tại.',
    'regex'                => 'Trường :attribute có định dạng không hợp lệ.',
    'required'             => 'Trường :attribute không được bỏ trống.',
    'required_array_keys'  => 'Trường :attribute phải bao gồm các mục nhập cho: :values.',
    'required_if'          => 'Trường :attribute không được bỏ trống khi trường :other là :value.',
    'required_if_accepted' => 'Trường :attribute không được bỏ trống khi :other được chấp nhận.',
    'required_unless'      => 'Trường :attribute không được bỏ trống trừ khi :other là :values.',
    'required_with'        => 'Trường :attribute không được bỏ trống khi một trong :values có giá trị.',
    'required_with_all'    => 'Trường :attribute không được bỏ trống khi tất cả :values có giá trị.',
    'required_without'     => 'Trường :attribute không được bỏ trống khi một trong :values không có giá trị.',
    'required_without_all' => 'Trường :attribute không được bỏ trống khi tất cả :values không có giá trị.',
    'same'                 => 'Trường :attribute và :other phải giống nhau.',
    'size'                 => [
        'array'   => 'Trường :attribute phải chứa :size phần tử.',
        'file'    => 'Dung lượng tập tin trong trường :attribute phải bằng :size kB.',
        'numeric' => 'Trường :attribute phải bằng :size.',
        'string'  => 'Trường :attribute phải chứa :size kí tự.',
    ],
    'starts_with'          => 'Trường :attribute phải được bắt đầu bằng một trong những giá trị sau: :values',
    'string'               => 'Trường :attribute phải là một chuỗi kí tự.',
    'timezone'             => 'Trường :attribute phải là một múi giờ hợp lệ.',
    'ulid'                 => 'Trường :attribute phải là một ULID hợp lệ.',
    'unique'               => 'Trường :attribute đã có trong cơ sở dữ liệu.',
    'uploaded'             => 'Trường :attribute tải lên thất bại.',
    'uppercase'            => 'Trường :attribute phải là chữ in hoa.',
    'url'                  => 'Trường :attribute không giống với định dạng một URL.',
    'uuid'                 => 'Trường :attribute phải là một chuỗi UUID hợp lệ.',
    'attributes'           => [
        'address'                  => 'địa chỉ',
        'affiliate_url'            => 'URL liên kết',
        'age'                      => 'tuổi',
        'amount'                   => 'số lượng',
        'announcement'             => 'thông báo',
        'area'                     => 'khu vực',
        'audience_prize'           => 'giải thưởng khán giả',
        'audience_winner'          => 'audience winner',
        'available'                => 'có sẵn',
        'birthday'                 => 'ngày sinh nhật',
        'body'                     => 'nội dung',
        'city'                     => 'thành phố',
        'company'                  => 'company',
        'compilation'              => 'biên soạn',
        'concept'                  => 'ý tưởng',
        'conditions'               => 'điều kiện',
        'content'                  => 'nội dung',
        'contest'                  => 'contest',
        'country'                  => 'quốc gia',
        'cover'                    => 'che phủ',
        'created_at'               => 'tạo lúc',
        'creator'                  => 'người sáng tạo',
        'currency'                 => 'tiền tệ',
        'current_password'         => 'mật khẩu hiện tại',
        'customer'                 => 'khách hàng',
        'date'                     => 'ngày',
        'date_of_birth'            => 'ngày sinh',
        'dates'                    => 'ngày',
        'day'                      => 'ngày',
        'deleted_at'               => 'xoá lúc',
        'description'              => 'mô tả',
        'display_type'             => 'kiểu hiển thị',
        'district'                 => 'quận/huyện',
        'duration'                 => 'khoảng thời gian',
        'email'                    => 'e-mail',
        'excerpt'                  => 'trích dẫn',
        'filter'                   => 'lọc',
        'finished_at'              => 'kết thúc lúc',
        'first_name'               => 'tên',
        'gender'                   => 'giới tính',
        'grand_prize'              => 'giải thưởng lớn',
        'group'                    => 'nhóm',
        'hour'                     => 'giờ',
        'image'                    => 'hình ảnh',
        'image_desktop'            => 'hình ảnh máy tính để bàn',
        'image_main'               => 'hình ảnh chính',
        'image_mobile'             => 'hình ảnh di động',
        'images'                   => 'hình ảnh',
        'is_audience_winner'       => 'khán giả là người chiến thắng',
        'is_hidden'                => 'bị ẩn',
        'is_subscribed'            => 'đã được đăng ký',
        'is_visible'               => 'có thể nhìn thấy',
        'is_winner'                => 'là người chiến thắng',
        'items'                    => 'mặt hàng',
        'key'                      => 'chìa khóa',
        'last_name'                => 'họ',
        'lesson'                   => 'bài học',
        'line_address_1'           => 'địa chỉ dòng 1',
        'line_address_2'           => 'địa chỉ dòng 2',
        'login'                    => 'đăng nhập',
        'message'                  => 'lời nhắn',
        'middle_name'              => 'tên đệm',
        'minute'                   => 'phút',
        'mobile'                   => 'di động',
        'month'                    => 'tháng',
        'name'                     => 'tên',
        'national_code'            => 'mã quốc gia',
        'number'                   => 'số',
        'password'                 => 'mật khẩu',
        'password_confirmation'    => 'xác nhận mật khẩu',
        'phone'                    => 'số điện thoại',
        'photo'                    => 'tấm ảnh',
        'portfolio'                => 'danh mục đầu tư',
        'postal_code'              => 'mã bưu điện',
        'preview'                  => 'xem trước',
        'price'                    => 'giá',
        'product_id'               => 'ID sản phẩm',
        'product_uid'              => 'UID sản phẩm',
        'product_uuid'             => 'sản phẩm UUID',
        'promo_code'               => 'mã khuyến mại',
        'province'                 => 'tỉnh/thành phố',
        'quantity'                 => 'Số lượng',
        'reason'                   => 'lý do',
        'recaptcha_response_field' => 'trường phản hồi recaptcha',
        'referee'                  => 'trọng tài',
        'referees'                 => 'trọng tài',
        'reject_reason'            => 'lý do từ chối',
        'remember'                 => 'ghi nhớ',
        'restored_at'              => 'khôi phục tại',
        'result_text_under_image'  => 'văn bản kết quả dưới hình ảnh',
        'role'                     => 'vai diễn',
        'rule'                     => 'luật lệ',
        'rules'                    => 'quy tắc',
        'second'                   => 'giây',
        'sex'                      => 'giới tính',
        'shipment'                 => 'lô hàng',
        'short_text'               => 'văn bản ngắn',
        'size'                     => 'kích thước',
        'skills'                   => 'kỹ năng',
        'slug'                     => 'sên',
        'specialization'           => 'chuyên môn hóa',
        'started_at'               => 'bắt đầu lúc',
        'state'                    => 'tình trạng',
        'status'                   => 'trạng thái',
        'street'                   => 'đường',
        'student'                  => 'học sinh',
        'subject'                  => 'tiêu đề',
        'tag'                      => 'nhãn',
        'tags'                     => 'thẻ',
        'teacher'                  => 'giáo viên',
        'terms'                    => 'điều kiện',
        'test_description'         => 'mô tả thử nghiệm',
        'test_locale'              => 'ngôn ngữ kiểm tra',
        'test_name'                => 'tên kiểm tra',
        'text'                     => 'văn bản',
        'time'                     => 'thời gian',
        'title'                    => 'tiêu đề',
        'type'                     => 'kiểu',
        'updated_at'               => 'cập nhật lúc',
        'user'                     => 'người dùng',
        'username'                 => 'tên đăng nhập',
        'value'                    => 'giá trị',
        'winner'                   => 'winner',
        'work'                     => 'work',
        'year'                     => 'năm',
    ],
];
