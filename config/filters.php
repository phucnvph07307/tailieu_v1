<?php

return [
    'quan_ly_giao_vien' => [
        'url' => '',
        'partials' => [
            'giao_vien_id' => [
                'label' => 'Tên giáo viên',
//                'select2' => true,
//                'options' => [],
//                'default' => 'Chọn giáo viên',
            ],
            'trinh_do_id' => [
                'label' => 'Trình độ',
                'select2' => true,
                'options' => [],
                'default' => 'Chọn trình độ',
            ],
            'co_so_id' => [
                'label' => 'Tên cơ sở',
                'select2' => true,
                'options' => [],
                'default' => 'Chọn cơ sở',
            ],
            'nghiep_vu_su_pham' => [
                'label' => "Nghiệp vụ sư phạm",
                'select2' => true,
                'options' => [],
                'default' => 'Chọn nghiệp vụ sư phạm',
            ],
        ],
    ],
    'so_lieu_can_bo_quan_ly' => [
        'url' => '',
        'partials' => [
            'co_so_dao_tao_id' => [
                'label' => 'Cơ sở đào tạo',
                'select2' => true,
                'options' => [],
                'default' => 'Chọn cơ sở đào tạo',
            ],
            'loai_hinh_id' => [
                'label' => 'Loại hình',
                'select2' => true,
                'options' => [],
                'default' => 'Chọn loại hình',
            ],
            'nam' => [
                'label' => 'Năm',
                'select2' => true,
                'options' => [],
                'default' => 'Chọn năm',
            ],
            'dot' => [
                'label' => "Đợt",
                'select2' => true,
                'options' => [],
                'default' => 'Chọn đợt',
            ],
            // 'trang_thai_id' => [
            //     'label' => "Trạng thái",
            //     'select2' => true,
            //     'options' => [],
            //     'default' => 'Chọn trạng thái',
            // ],
        ],
    ],
];
