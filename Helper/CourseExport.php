<?php

namespace Foostart\Pexcel\Helper;

use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CourseExport implements FromView {

    public $course;
    public $view;
    public $courseName;
    public $counterUnCompany;

    public $ids;

    public function view(): View
    {

        return view($this->view, [
            'items' => $this->course,
            'courseName' => $this->courseName,
            'counterUnCompany' => $this->counterUnCompany
        ]);
    }

    public function query()
    {
        $sql = "SELECT *, count(*)
                    FROM (
                        SELECT
                            internship.`course_id`,
                            company_name,
                            company_instructor_phone,
                            CONCAT_WS('\n', company_address, company_phone) as company_address
                        FROM internship
                        INNER JOIN `classes_users`
                            ON `internship`.user_id = `classes_users`.user_id
                        WHERE (internship.`course_id` ) IN (1)
                        GROUP BY internship.user_id
                        ORDER BY internship.course_id
                    ) AS company_info
                    GROUP BY company_info.company_instructor_phone
                    ORDER BY course_id;
                ";
    }

}
