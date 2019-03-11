<?php

namespace App\Http\Controllers\API\v1;

use App\Repositories\v1\CompanyRepository;
use Illuminate\Http\Request;
use App\Services\v2\ExternalCompanyAPIService as Service;


/**
 * Class constantsController
 * @package App\Http\Controllers\API
 */
class CompaniesAPIController extends AppAPIv1BaseController
{
    /** @var  CompanyRepository */
    private $companyRepository;


    public function company(Request $request)
    {
        $input = $this->validate($request, [
            'tin' => 'required|string|size:9'
        ]);
        $company = Service::getCompany($input['tin']);
//        $company = [
//            'ACRON_UZ' => "BISH-SERVIS ДП",
//            'ADDR' => ",ПЛ.Х.АЛИМДЖАНА,2Б,",
//            'AUTH_CAPITAL' => "4678785",
//            'AUTH_CAPITAL_US' => "",
//            'EMAIL' => "",
//            'EMP_AVR' => "23",
//            'FOUNDER_COUNTRY1' => "860",
//            'FOUNDER_COUNTRY2' => "",
//            'FOUNDER_COUNTRY3' => "",
//            'FOUNDER_COUNTRY4' => "",
//            'FOUNDER_COUNTRY5' => "",
//            'FOUNDER_NM1' => "Toshkent shahar Xokimligi binolardan foydalanish departamenti",
//            'FOUNDER_NM2' => "",
//            'FOUNDER_NM3' => "",
//            'FOUNDER_NM4' => "",
//            'FOUNDER_NM5' => "",
//            'HEAD_NM' => "БАТИРОВ РУСЛАН УМАРОВИЧ",
//            'HEAD_TIN' => "456289422",
//            'KFS_CD' => "148",
//            'KFS_DESC_EN' => "",
//            'KFS_DESC_RU' => "Собственность дочерних хозяйственных обществ",
//            'KFS_DESC_UZ' => "Sho'bа xo'jаlik jаmiyatlаr mulki",
//            'KOPF_CD' => "190",
//            'KOPF_DESC_EN' => "",
//            'KOPF_DESC_RU' => "Коммерческая организация, не включенная в другие группировки",
//            'KOPF_DESC_UZ' => "Boshqa guruhlarga kiritilmagan tijoratchi tashkilot",
//            'LE_ID' => "9621208",
//            'LE_NM_UZ' => "BISH-SERVIS ДП",
//            'LE_STATUS' => "0",
//            'LE_TYP' => "2",
//            'LIQ_DATE' => "",
//            'LIQ_NO' => "",
//            'OKED_CD' => "52210",
//            'OKED_DESC_EN' => "",
//            'OKED_DESC_RU' => "Услуги в области сухопутного транспорта",
//            'OKED_DESC_UZ' => "Quruqlik trаnsporti sohаsidаgi xizmаtlаr",
//            'OKONH_CD' => "51111",
//            'OKONH_DESC_EN' => "",
//            'OKONH_DESC_RU' => "Hаземный железнодорожный транспорт общего пользования (без трамвайного)",
//            'OKONH_DESC_UZ' => "Umumfoydаlаnishdаgi erusti temiryo'l trаnsporti (trаmvаydаn tаshqаri)",
//            'OKPO' => "18191452",
//            'PHONE' => "2372969",
//            'REG_DATE' => "17092001",
//            'REG_NO' => "1371",
//            'SMALL_BIZ' => "N",
//            'SOATO_CD' => "1726269",
//            'SOATO_DESC_EN' => "",
//            'SOATO_DESC_RU' => "Мирзо-Улугбекский район",
//            'SOATO_DESC_UZ' => "Mirzo Ulug'bek tumani",
//            'SOOGU_CD' => "01011",
//            'SOOGU_DESC_EN' => "",
//            'SOOGU_DESC_RU' => "Юридические лица, учрежденные органами власти на местах",
//            'SOOGU_DESC_UZ' => "Маҳаллий ҳокимият органлари томонидан таъсис этилган юридик шахслар",
//            'TAX_CD' => "22",
//            'TIN' => "203695283",
//            'ZIP' => "100000",
//        ];
        return $this->sendResponse($company, 'Constant retrieved successfully');
    }

}
