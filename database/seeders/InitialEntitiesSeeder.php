<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyAffiliate;
use App\Models\CompanyDescribingInfo;
use App\Models\CompanyDesignInfo;
use App\Models\Employee;
use App\Models\Gender;
use App\Models\JobPosition;
use App\Models\Service;
use App\Models\StaffMember;
use App\Models\StaffMemberDescribingInfo;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;

class InitialEntitiesSeeder extends Seeder
{
    const _1 = 1000000001;
    const _2 = 1000000002;
    const _3 = 1000000003;
    const _4 = 1000000004;
    const _5 = 1000000005;
    const _6 = 1000000006;
    const _7 = 1000000007;
    const _8 = 1000000008;
    const _9 = 1000000009;
    const _10 = 10000000010;

    private array $companies = [
        [
            'id' => self::_1,
            'name' => 'Test Company',
            'code_name' => 'test_company',
            'bot_token' => '7311110449:AAG2N1qKDG6JLe002VMTmDS3gXvxinDuU8g',
            'company_type_id' => 1
        ]
    ];

    private array $companyDesignInfos = [
        [
            'id' => self::_1,
            'company_id' => self::_1,
        ]
    ];

    private array $companyDescribingInfos = [
        [
            'id' => self::_1,
            'company_id' => self::_1,
            'main_link' => 'https://0370.ru/',
            'phone_number' => '73822900303',
            'address' => 'г. Томск, ул. Трифонова, д. 22Б',
            'email' => 'info@0370.ru'
        ]
    ];

    private array $companyAffiliates = [
        [
            'id' => self::_1,
            'company_id' => self::_1,
            'name' => 'Филиал на Трифонова (главный)',
            'address' => 'г. Томск, ул. Трифонова, д. 22Б',
            'phone_number' => '73822900303',
            'is_main' => 1,
            'latitude' => 56.479318,
            'longitude' => 84.950191
        ],
        [
            'id' => self::_2,
            'company_id' => self::_1,
            'name' => 'Филиал на Киевской',
            'address' => 'г. Томск, ул. Киевская, д. 15',
            'phone_number' => '73822990091',
            'is_main' => 0,
            'latitude' => 56.479273,
            'longitude' => 84.980126
        ],
        [
            'id' => self::_3,
            'company_id' => self::_1,
            'name' => 'Филиал на Сибирской',
            'address' => 'г. Томск, ул. Сибирская, д. 104/4',
            'phone_number' => '73822331100',
            'is_main' => 0,
            'latitude' => 56.477922,
            'longitude' => 84.992777
        ],
        [
            'id' => self::_4,
            'company_id' => self::_1,
            'name' => 'Филиал на Войкова',
            'address' => 'г. Томск, ул. Войкова, д. 55',
            'phone_number' => '73822409171',
            'is_main' => 0,
            'latitude' => 56.501818,
            'longitude' => 84.971723
        ],
        [
            'id' => self::_5,
            'company_id' => self::_1,
            'name' => 'Филиал на Смирнова',
            'address' => 'г. Томск, ул. Смирнова, д. 30',
            'phone_number' => '73822628884',
            'is_main' => 0,
            'latitude' => 56.512117,
            'longitude' => 84.991959
        ]
    ];

    private array $staffMembers = [
        [
            'id' => self::_1,
            'company_id' => self::_1,
            'name' => 'Альфред',
            'surname' => 'Егоров',
            'patronymic' => 'Аристархович'
        ],
        [
            'id' => self::_2,
            'company_id' => self::_1,
            'name' => 'Остап',
            'surname' => 'Носов',
            'patronymic' => 'Еремеевич'
        ],
        [
            'id' => self::_3,
            'company_id' => self::_1,
            'name' => 'Август',
            'surname' => 'Михеев',
            'patronymic' => 'Филиппович'
        ],
        [
            'id' => self::_4,
            'company_id' => self::_1,
            'name' => 'Кондрат',
            'surname' => 'Назаров',
            'patronymic' => 'Борисович'
        ],
        [
            'id' => self::_5,
            'company_id' => self::_1,
            'name' => 'Ярослав',
            'surname' => 'Бобылёв',
            'patronymic' => 'Евсеевич'
        ],
        [
            'id' => self::_6,
            'company_id' => self::_1,
            'name' => 'Мелиана',
            'surname' => 'Белоусова',
            'patronymic' => 'Германновна'
        ],
        [
            'id' => self::_7,
            'company_id' => self::_1,
            'name' => 'Снежана',
            'surname' => 'Голубева',
            'patronymic' => 'Еремеевна'
        ],
        [
            'id' => self::_8,
            'company_id' => self::_1,
            'name' => 'Неонила',
            'surname' => 'Щукина',
            'patronymic' => 'Романовна'
        ],
        [
            'id' => self::_9,
            'company_id' => self::_1,
            'name' => 'Инара',
            'surname' => 'Королёва',
            'patronymic' => 'Альбертовна'
        ],
        [
            'id' => self::_10,
            'company_id' => self::_1,
            'name' => 'Екатерина',
            'surname' => 'Кудрявцева',
            'patronymic' => 'Федоровна'
        ]
    ];

    private array $staffMemberDescribingInfos = [
        [
            'id' => self::_1,
            'staff_member_id' => self::_1,
            'gender_id' => 1,
            'phone_number' => '7' . self::_1,
            'date_of_birth' => '1979-11-23',
            'description' => 'Опытный хирург, специализирующийся на сложных операциях в области абдоминальной хирургии. Благодаря многолетнему опыту и высокому профессионализму, Альфред Аристархович заслужил доверие своих пациентов и коллег.'
        ],
        [
            'id' => self::_2,
            'staff_member_id' => self::_2,
            'gender_id' => 1,
            'phone_number' => '7' . self::_2,
            'date_of_birth' => '2002-03-01',
            'description' => 'Кардиолог с более чем 15-летним стажем. Он активно занимается лечением сердечно-сосудистых заболеваний, уделяя особое внимание профилактике и ранней диагностике. Его пациенты ценят Остапа Еремеевича за чуткость и внимательность.'
        ],
        [
            'id' => self::_3,
            'staff_member_id' => self::_3,
            'gender_id' => 1,
            'phone_number' => '7' . self::_3,
            'date_of_birth' => '1991-12-12',
            'description' => 'Эндокринолог с широким опытом работы в диагностике и лечении заболеваний щитовидной железы и диабета. Август Филиппович постоянно повышает свою квалификацию, внедряя современные методики лечения.'
        ],
        [
            'id' => self::_4,
            'staff_member_id' => self::_4,
            'gender_id' => 1,
            'phone_number' => '7' . self::_4,
            'date_of_birth' => '1956-06-18',
            'description' => 'Ведущий педиатр, который посвятил свою карьеру заботе о здоровье детей. Он известен своим внимательным подходом и умением находить общий язык с маленькими пациентами и их родителями.'
        ],
        [
            'id' => self::_5,
            'staff_member_id' => self::_5,
            'gender_id' => 1,
            'phone_number' => '7' . self::_5,
            'date_of_birth' => '1967-10-15',
            'description' => 'Невролог, специализирующийся на лечении заболеваний центральной нервной системы. Ярослав Евсеевич активно участвует в научных исследованиях и разработке новых методов лечения неврологических расстройств.'
        ],
        [
            'id' => self::_6,
            'staff_member_id' => self::_6,
            'gender_id' => 2,
            'phone_number' => '7' . self::_6,
            'date_of_birth' => '2005-04-18',
            'description' => 'Врач-офтальмолог с многолетним опытом. Мелиана Германновна специализируется на диагностике и лечении заболеваний сетчатки и зрительного нерва. Её профессионализм и внимательность к деталям делают её незаменимым специалистом.'
        ],
        [
            'id' => self::_7,
            'staff_member_id' => self::_7,
            'gender_id' => 2,
            'phone_number' => '7' . self::_7,
            'date_of_birth' => '1998-01-23',
            'description' => 'Дерматолог, которая успешно лечит широкий спектр кожных заболеваний, от акне до хронических дерматитов. Снежана Еремеевна также уделяет внимание косметическим аспектам дерматологии, помогая пациентам поддерживать здоровье кожи.'
        ],
        [
            'id' => self::_8,
            'staff_member_id' => self::_8,
            'gender_id' => 2,
            'phone_number' => '7' . self::_8,
            'date_of_birth' => '1975-08-30',
            'description' => 'Терапевт с многолетним опытом. Она специализируется на комплексном подходе к лечению хронических заболеваний и активно работает с пациентами на стадии реабилитации, помогая им вернуться к полноценной жизни.'
        ],
        [
            'id' => self::_9,
            'staff_member_id' => self::_9,
            'gender_id' => 2,
            'phone_number' => '7' . self::_9,
            'date_of_birth' => '1959-09-11',
            'description' => 'Опытный гастроэнтеролог, известная своим индивидуальным подходом к каждому пациенту. Она успешно лечит заболевания желудочно-кишечного тракта, уделяя особое внимание вопросам правильного питания и образа жизни.'
        ],
        [
            'id' => self::_10,
            'staff_member_id' => self::_10,
            'gender_id' => 2,
            'phone_number' => '7' . self::_10,
            'date_of_birth' => '1985-02-19',
            'description' => 'Гинеколог-эндокринолог с глубокими знаниями в области репродуктивного здоровья женщин. Екатерина Федоровна ведёт приём пациентов всех возрастов, помогая им решать сложные вопросы женского здоровья с учётом последних достижений медицины.'
        ]
    ];

    private array $services = [
        [
            'id' => self::_1,
            'name' => 'Консультация терапевта',
            'allocated_time' => '00:15:00',
            'company_id' => self::_1,
            'price' => '1000'
        ],
        [
            'id' => self::_2,
            'name' => 'ЭКГ с расшифровкой',
            'allocated_time' => '00:30:00',
            'company_id' => self::_1,
            'price' => '750',
        ],
        [
            'id' => self::_3,
            'name' => 'Ультразвуковое исследование (УЗИ) органов брюшной полости',
            'allocated_time' => '00:15:00',
            'company_id' => self::_1,
            'price' => '400',
        ],
        [
            'id' => self::_4,
            'name' => 'Комплексное обследование щитовидной железы',
            'allocated_time' => '01:30:00',
            'company_id' => self::_1,
            'price' => '3500',
        ],
        [
            'id' => self::_5,
            'name' => 'Лечение хронических дерматологических заболеваний',
            'allocated_time' => '02:30:00',
            'company_id' => self::_1,
            'price' => '11000',
        ]
    ];

    private array $jobPositions = [
        [
            'id' => self::_1,
            'name' => 'Гинеколог',
            'company_id' => self::_1,
        ],
        [
            'id' => self::_2,
            'name' => 'Уролог',
            'company_id' => self::_1,
        ],
        [
            'id' => self::_3,
            'name' => 'Ревматолог',
            'company_id' => self::_1,
        ],
        [
            'id' => self::_4,
            'name' => 'Дерматолог',
            'company_id' => self::_1,
        ],
        [
            'id' => self::_5,
            'name' => 'Пульмонолог',
            'company_id' => self::_1,
        ]
    ];

    private array $jobPositionService = [
        [
            'service_id' => self::_1,
            'job_position_id' => self::_1,
        ],
        [
            'service_id' => self::_2,
            'job_position_id' => self::_2,
        ],
        [
            'service_id' => self::_3,
            'job_position_id' => self::_3,
        ],
        [
            'service_id' => self::_4,
            'job_position_id' => self::_4,
        ],
        [
            'service_id' => self::_5,
            'job_position_id' => self::_5,
        ],
        [
            'service_id' => self::_1,
            'job_position_id' => self::_2,
        ],
        [
            'service_id' => self::_2,
            'job_position_id' => self::_3,
        ],
        [
            'service_id' => self::_3,
            'job_position_id' => self::_4,
        ],
        [
            'service_id' => self::_4,
            'job_position_id' => self::_5,
        ],
        [
            'service_id' => self::_5,
            'job_position_id' => self::_1,
        ]
    ];

    private array $employees = [
        [
            'id' => self::_1,
            'staff_member_id' => self::_1,
            'job_position_id' => self::_1,
            'company_affiliate_id' => self::_1,
        ],
        [
            'id' => self::_2,
            'staff_member_id' => self::_3,
            'job_position_id' => self::_2,
            'company_affiliate_id' => self::_4,
        ],
        [
            'id' => self::_3,
            'staff_member_id' => self::_5,
            'job_position_id' => self::_4,
            'company_affiliate_id' => self::_3,
        ],
        [
            'id' => self::_4,
            'staff_member_id' => self::_2,
            'job_position_id' => self::_5,
            'company_affiliate_id' => self::_1,
        ],
        [
            'id' => self::_5,
            'staff_member_id' => self::_4,
            'job_position_id' => self::_3,
            'company_affiliate_id' => self::_2,
        ],
        [
            'id' => self::_6,
            'staff_member_id' => self::_2,
            'job_position_id' => self::_1,
            'company_affiliate_id' => self::_5,
        ],
        [
            'id' => self::_7,
            'staff_member_id' => self::_3,
            'job_position_id' => self::_5,
            'company_affiliate_id' => self::_1,
        ],
        [
            'id' => self::_8,
            'staff_member_id' => self::_5,
            'job_position_id' => self::_4,
            'company_affiliate_id' => self::_2,
        ],
        [
            'id' => self::_9,
            'staff_member_id' => self::_1,
            'job_position_id' => self::_3,
            'company_affiliate_id' => self::_5,
        ],
        [
            'id' => self::_10,
            'staff_member_id' => self::_4,
            'job_position_id' => self::_2,
            'company_affiliate_id' => self::_3,
        ],
    ];

    public function run(): void
    {
        Company::query()->insertOrIgnore($this->companies);
        CompanyDesignInfo::query()->insertOrIgnore($this->companyDesignInfos);
        CompanyDescribingInfo::query()->insertOrIgnore($this->companyDescribingInfos);
        CompanyAffiliate::query()->insertOrIgnore($this->companyAffiliates);
        StaffMember::query()->insertOrIgnore($this->staffMembers);
        StaffMemberDescribingInfo::query()->insertOrIgnore($this->staffMemberDescribingInfos);
        Service::query()->insertOrIgnore($this->services);
        JobPosition::query()->insertOrIgnore($this->jobPositions);
        Employee::query()->insertOrIgnore($this->employees);

        foreach ($this->jobPositionService as $jobPosition) {
            JobPosition::query()->find($jobPosition['job_position_id'])->services()->attach($jobPosition['service_id']);
        }

        foreach ($this->employees as $employee) {
            $employee = Employee::query()->find($employee['id']);
            
            $startDate = CarbonImmutable::now()->startOfDay();
            $endDate = CarbonImmutable::now()->addDays(90)->startOfDay();

            while ($endDate->day !== $startDate->day) {
                $startTime = $startDate->addHours(8);
                $endTime = $startDate->addHours(18);

                while ($endTime->hour !== $startTime->hour) {
                    $employee->periods()->create([
                        'date' => $startDate->toDateString(),
                        'start_time' => $startTime->toTimeString(),
                        'end_time' => $startTime->addMinutes(15)->toTimeString()
                    ]);

                    $startTime = $startTime->addMinutes(15);
                }

                $startDate = $startDate->addDay();
            }
        }
    }
}
