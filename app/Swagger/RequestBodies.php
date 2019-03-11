<?php
/**
 * Created by PhpStorm.
 * User: farrukh-b
 * Date: 13.11.2018
 * Time: 13:31
 */

/**
 * @OA\RequestBody(
 *     request="Contract",
 *     description="Contract object that needs to be added to the store",
 *     required=true,
 *     @OA\JsonContent(ref="#/components/schemas/Lc"),
 * )
 * @OA\RequestBody(
 *     request="Structure",
 *     description="Structure object that needs to be added to the store",
 *     required=true,
 *     @OA\JsonContent(ref="#/components/schemas/Structures"),
 * )
 * @OA\RequestBody(
 *     request="Position",
 *     description="Position object that needs to be added to the store",
 *     required=true,
 *     @OA\JsonContent(ref="#/components/schemas/Positions"),
 * )
 */

/**
 * @OA\RequestBody(
 *     request="LcStore",
 *     description="Contract object that needs to be added to the store",
 *     required=true,
 *     @OA\JsonContent(
 *  @OA\Items(
 *     title="Трудовые договоры",
 *     description="Трудовые договоры",
 *     required={
 *        "pin_lc",
 *        "tin_lc",
 *        "name_company_lc",
 *        "tax_person_lc",
 *        "type_emp_lc",
 *        "passport_lc",
 *        "date_start_lc",
 *        "name_person_lc",
 *        "family_person_lc",
 *        "main_work_lc",
 *        "date_start_lc"
 *     },
 *     example={
 *       "pin_lc":"10100000000001",
 *       "tin_lc":"100000005",
 *       "name_company_lc":"ORG2",
 *       "code_prof_lc":"5",
 *       "order_lc":"order #123",
 *       "salary_lc":1000000.00,
 *       "tax_person_lc":"100000001",
 *       "article_lc":"Статья увольнения",
 *       "type_emp_lc":"1",
 *       "code_nskz_lc":"1232",
 *       "id_position_lc":"3",
 *       "passport_lc":"AA1234567",
 *       "date_order_lc":"2018-11-12",
 *       "date_start_lc":"2018-11-28",
 *       "name_person_lc":"Ivan",
 *       "term_salary_lc":1,
 *       "family_person_lc":"Ivanov",
 *       "value_fields_lc":{"a": "b"},
 *       "middlename_person_lc":"Ivanovich",
 *       "main_work_lc":true,
 *       "date_of_contract_lc":"2018-11-21",
 *     },
 * )))
 */

/**
 * @OA\RequestBody(
 *     request="LcUpdate",
 *     description="Contract object that needs to be added to the store",
 *     required=true,
 *     @OA\JsonContent(
 *     @OA\Items(
 *     title="Трудовые договоры",
 *     description="Трудовые договоры",
 *     required={
 *        "pin_lc",
 *        "tin_lc",
 *        "name_company_lc",
 *        "code_prof_lc",
 *        "tax_person_lc",
 *        "type_emp_lc",
 *        "passport_lc",
 *        "name_person_lc",
 *        "family_person_lc",
 *        "main_work_lc",
 *        "date_start_lc"
 * },
 *     example={
 *       "name_company_lc":"ORG2",
 *       "code_prof_lc":"5",
 *       "order_lc":"order #123",
 *       "salary_lc":1000000.00,
 *       "article_lc":"Статья увольнения",
 *       "type_emp_lc":"1",
 *       "code_nskz_lc":"1232",
 *       "passport_lc":"AA1234567",
 *       "date_start_lc":"2018-11-28",
 *       "term_salary_lc":1,
 *       "family_person_lc":"Ivanov",
 *       "value_fields_lc":"{}",
 *       "middlename_person_lc":"Ivanovich",
 *       "main_work_lc":true,
 *       "date_of_contract_lc":"2018-11-21",
 *     },
 *
 * @OA\Schema(
 * @OA\Items(
 * @OA\Property(
 *     format="int64",
 *     title="Идентификатор ТД",
 *     property="id_lc",
 *     description="id_lc",
 * ),
 *
 *
 * @OA\Property(
 *     format="int64",
 *     title="Уникальный идентификатор родительской записи",
 *     property="parent_id_lc",
 *     description="Родительская запись",
 * ),
 *
 *
 * @OA\Property(
 *     format="boolean",
 *     title="Признак актуальности ТД",
 *     property="active_lc",
 *     description="Признак актуальности ТД",
 * ),
 *
 *
 * @OA\Property(
 *     format="timestamp",
 *     title="Дата создания записи в БД",
 *     property="datetime_lc",
 *     description="Дата создания записи в БД",
 * ),
 *
 *
 * @OA\Property(
 *     format="int2",
 *     title="Типизация ТД",
 *     property="type_lc",
 *     description="Типизация ТД",
 * ),
 *
 *
 * @OA\Property(
 *     format="boolean",
 *     title="Направление записи ТД",
 *     property="direct_lc",
 *     description="Направление записи ТД",
 * ),
 *
 *
 * @OA\Property(
 *     format="int64",
 *     title="Редактируемая запись",
 *     property="edit_id_lc",
 *     description="Редактируемая запись",
 * ),
 *
 *
 * @OA\Property(
 *     format="string",
 *     title="Идентификатор ФЛ",
 *     property="pin_lc",
 *     description="Идентификатор ФЛ",
 * ),
 *
 *
 * @OA\Property(
 *     format="string",
 *     title="ИНН ФЛ в ТД",
 *     property="tax_person_lc",
 *     description="ИНН ФЛ в ТД",
 * ),
 *
 *
 * @OA\Property(
 *     format="string",
 *     title="Паспорт",
 *     property="passport_lc",
 *     description="Паспорт",
 * ),
 *
 *
 * @OA\Property(
 *     format="string",
 *     title="Фамилия",
 *     property="family_person_lc",
 *     description="Фамилия",
 * ),
 *
 *
 * @OA\Property(
 *     format="string",
 *     title="Имя",
 *     property="name_person_lc",
 *     description="Имя",
 * ),
 *
 *
 * @OA\Property(
 *     format="string",
 *     title="Отчество",
 *     property="middlename_person_lc",
 *     description="Отчество",
 * ),
 *
 *
 * @OA\Property(
 *     format="string",
 *     title="Идентификатор ЮЛ (ИНН)",
 *     property="tin_lc",
 *     description="Идентификатор ЮЛ (ИНН)",
 * ),
 *
 *
 * @OA\Property(
 *     format="string",
 *     title="Наименование ЮЛ",
 *     property="name_company_lc",
 *     description="Наименование ЮЛ",
 * ),
 *
 *
 * @OA\Property(
 *     format="string",
 *     title="ОКЭД в ТД",
 *     property="oked_lc",
 *     description="ОКЭД в ТД",
 * ),
 *
 *
 * @OA\Property(
 *     format="string",
 *     title="СОАТО ЮЛ",
 *     property="regionent_lc",
 *     description="СОАТО ЮЛ",
 * ),
 *
 *
 * @OA\Property(
 *     format="string",
 *     title="Подразделение",
 *     property="name_structure_lc",
 *     description="Подразделение",
 * ),
 *
 *
 * @OA\Property(
 *     format="string",
 *     title="Должность",
 *     property="name_position_lc",
 *     description="Должность",
 * ),
 *
 *
 * @OA\Property(
 *     format="string",
 *     title="Код профессии, должности",
 *     property="code_prof_lc",
 *     description="Код профессии, должности",
 * ),
 *
 *
 * @OA\Property(
 *     format="int64",
 *     title="Уникальный идентификатор должности",
 *     property="id_position_lc",
 *     description="Уникальный идентификатор должности",
 * ),
 *
 *
 * @OA\Property(
 *     format="float",
 *     title="Зарплата",
 *     property="salary_lc",
 *     description="Зарплата",
 * ),
 *
 *
 * @OA\Property(
 *     format="boolean",
 *     title="Признак надбавка",
 *     property="flag_bonus_lc",
 *     description="Признак надбавка",
 * ),
 *
 *
 * @OA\Property(
 *     format="int2",
 *     title="Условия оплаты труда",
 *     property="term_salary_lc",
 *     description="Условия оплаты труда",
 * ),
 *
 *
 * @OA\Property(
 *     format="int2",
 *     title="Вид занятости ТД",
 *     property="type_emp_lc",
 *     description="Вид занятости ТД",
 * ),
 *
 *
 * @OA\Property(
 *     format="string",
 *     title="Код по НСКЗ",
 *     property="code_nskz_lc",
 *     description="Код по НСКЗ",
 * ),
 *
 *
 * @OA\Property(
 *     format="string",
 *     title="Приказ",
 *     property="order_lc",
 *     description="Приказ",
 * ),
 *
 *
 * @OA\Property(
 *     format="date",
 *     title="Дата приказа",
 *     property="date_order_lc",
 *     description="Дата приказа",
 * ),
 *
 *
 * @OA\Property(
 *     format="string",
 *     title="Статья",
 *     property="article_lc",
 *     description="Статья",
 * ),
 *
 *
 * @OA\Property(
 *     format="string",
 *     title="Учебная специальность СПО",
 *     property="code_spec_spo_lc",
 *     description="Учебная специальность СПО",
 * ),
 *
 *
 * @OA\Property(
 *     format="string",
 *     title="Код специальности СПО",
 *     property="code_spo_lc",
 *     description="Код специальности СПО",
 * ),
 *
 *
 * @OA\Property(
 *     format="string",
 *     title="Учебная специальность ВО",
 *     property="spec_vo_lc",
 *     description="Учебная специальность ВО",
 * ),
 *
 *
 * @OA\Property(
 *     format="string",
 *     title="Код специальности ВО",
 *     property="code_vo_lc",
 *     description="Код специальности ВО",
 * ),
 *
 *
 * @OA\Property(
 *     format="string",
 *     title="Подтверждение работодателя",
 *     property="accept_employer_lc",
 *     description="Подтверждение работодателя",
 * ),
 *
 *
 * @OA\Property(
 *     format="int64",
 *     title="Идентификатор записи в Хранилище",
 *     property="id_lc_wh",
 *     description="Идентификатор записи в Хранилище",
 * ),
 *
 *
 * @OA\Property(
 *     format="array",
 *     title="Значения полей ТД",
 *     property="value_fields_lc",
 *     description="Значения полей ТД",
 * ),
 *
 *
 * @OA\Property(
 *     format="string",
 *     title="Идентификатор пользователя, создавшего запись",
 *     property="owner_lc",
 *     description="Идентификатор пользователя, создавшего запись",
 * ),
 *
 *
 * @OA\Property(
 *     format="string",
 *     title="ПИНФЛ пользователя, создавшего запись",
 *     property="owner_pin_lc",
 *     description="ПИНФЛ пользователя, создавшего запись",
 * ),
 *
 *
 * @OA\Property(
 *     format="boolean",
 *     title="СОАТО пользователя, создавшего запись",
 *     property="owner_region_lc",
 *     description="СОАТО пользователя, создавшего запись",
 * ),
 *
 *
 * @OA\Property(
 *     format="int64",
 *     title="ИНН компании, пользователя, создавшего запись",
 *     property="owner_tin_lc",
 *     description="ИНН компании, пользователя, создавшего запись",
 * ),
 *
 *
 * @OA\Property(
 *     format="date",
 *     title="Дата заключения ТД",
 *     property="date_of_contract_lc",
 *     description="Дата заключения ТД",
 * ),
 *
 *
 * @OA\Property(
 *     format="string",
 *     title="Признак основной работы",
 *     property="main_work_lc",
 *     description="Признак основной работы",
 * ),
 *
 *
 * @OA\Property(
 *     format="int64",
 *     title="Уникальный идентификатор структуры организации",
 *     property="id_structure_lc",
 *     description="Уникальный идентификатор структуры организации",
 * ),
 *
 *
 * @OA\Property(
 *     format="int64",
 *     title="Уникальный идентификатор организации",
 *     property="id_company_lc",
 *     description="Уникальный идентификатор организации",
 * ),
 *
 *
 * @OA\Property(
 *     format="date",
 *     title="Дата начала ТД",
 *     property="date_start_lc",
 *     description="Дата начала ТД",
 * ),
 *
 *
 * @OA\Property(
 *     format="date",
 *     title="Дата конца ТД",
 *     property="date_end_lc",
 *     description="Дата конца ТД",
 * ),
 *))
 *
 *)))
 */


/**
 * @OA\RequestBody(
 *     request="StructuresStore",
 *     description="Structure object that needs to be added to the store",
 *     required=true,
 *     @OA\JsonContent(
 *     @OA\Items(
 *     title="Структура организации",
 *     description="Структура организации",
 *     required={
 *       "parent_id_structure",
 *        "name_structure",
 *        "date_start_structure"
 *      },
 *     example={
 *       "parent_id_structure": 5,
 *       "name_structure": "Отдел #2",
 *       "date_end_structure": "2018-12-12",
 *       "date_start_structure": "2017-12-12"
 *     },
 *
 *)))
 */

/**
 * @OA\RequestBody(
 *     request="StructuresUpdate",
 *     description="Structure object that needs to be updated in the store",
 *     required=true,
 *     @OA\JsonContent(
 *     @OA\Items(
 *     title="Структура организации",
 *     description="Структура организации",
 *     required={
 *       "parent_id_structure",
 *        "name_structure",
 *        "date_start_structure"
 *      },
 *     example={
 *       "parent_id_structure": 5,
 *       "name_structure": "Отдел #2",
 *       "date_end_structure": "2018-12-12",
 *       "date_start_structure": "2017-12-12"
 *     },
 *
 *)))
 */

/**
 * @OA\RequestBody(
 *     request="StructuresDestroy",
 *     description="Structure object that needs to be destroyed in the store",
 *     required=true,
 *     @OA\JsonContent(
 *     @OA\Items(
 *     title="Структура организации",
 *     description="Структура организации",
 *     required={
 *
 *      },
 *     example={
 *
 *     },
 *
 *)))
 */


/**
 * @OA\RequestBody(
 *     request="PositionsStore",
 *     description="Structure object that needs to be added to the store",
 *     required=true,
 *     @OA\JsonContent(
 *     @OA\Items(
 *     title="Структура организации",
 *     description="Структура организации",
 *     required={
 *       "id_structure_position",
 *       "name_position",
 *       "date_start_position",
 *       "code_prof_position",
 *       "salary_position"
 *      },
 *     example={
 *      "id_structure_position": 5,
 *      "name_position": "POS4_3",
 *      "date_end_position": "2018-12-08 00:00:00",
 *      "date_start_position": "2018-08-08 00:00:00.000000",
 *      "status_open_position": true,
 *      "requirements_position": "",
 *      "form_position": 1,
 *      "code_prof_position": "12",
 *      "salary_position": "1030000.00",
 *     },
 *)))
 */

/**
 * @OA\RequestBody(
 *     request="PositionsUpdate",
 *     description="Structure object that needs to be added to the store",
 *     required=true,
 *     @OA\JsonContent(
 *     @OA\Items(
 *     title="Структура организации",
 *     description="Структура организации",
 *     required={
 *
 *     },
 *     example={
 *      "id_structure_position": 5,
 *      "name_position": "POS4_3",
 *      "date_end_position": "2018-12-08 00:00:00",
 *      "date_start_position": "2018-08-08 00:00:00",
 *      "status_open_position": true,
 *      "requirements_position": "",
 *      "form_position": 1,
 *      "code_prof_position": "12",
 *     },
 *
 *)))
 */

/**
 * @OA\RequestBody(
 *     request="PositionsDestroy",
 *     description="Structure object that needs to be added to the store",
 *     required=true,
 *     @OA\JsonContent(
 *     @OA\Items(
 *     title="Структура организации",
 *     description="Структура организации",
 *     required={
 *      },
 *     example={
 *     },
 *
 *)))
 */

/**
 * @OA\RequestBody(
 *     request="ApproveCodeRequest",
 *     description="ApproveCode object that needs to be added to the store",
 *     required=true,
 *     @OA\JsonContent(
 *     @OA\Items(
 *     title="Запрос подтверждение контракта",
 *     description="Запрос подтверждение контракта",
 *     required={
 *     "id_lc",
 *     "phone_number"
 *     },
 *     example={
 *     "id_lc" : 1534573,
 *     "code" : 995240
 *      },
 *
 *)))
 */

/**
 * @OA\RequestBody(
 *     request="ApproveCodeApprove",
 *     description="ApproveCode object that needs to be added to the store",
 *     required=true,
 *     @OA\JsonContent(
 *     @OA\Items(
 *     title="Подтверждение контракта",
 *     description="Подтверждение контракта",
 *     required={
 *     "id_lc",
 *     "code"
 *     },
 *     example={
 *     "id_lc" : 1534573,
 *     "phone_number" : 998977806493
 *      },
 *
 *)))
 */