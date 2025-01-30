<?php
// Include database connection
include 'database.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $childNameNepali = $_POST['childNameNepali'];
    $childNameEnglish = $_POST['childNameEnglish'];
    $birthDateBS = $_POST['birthDateBS'];
    $birthDateAD = $_POST['birthDateAD'];
    $birthPlace = $_POST['birthPlace'];
    $birthAssistance = $_POST['birthAssistance'];
    $childGender = $_POST['childGender'];
    $ethnicity = $_POST['ethnicity'];
    $birthWeight = $_POST['birthWeight'];
    $birthType = $_POST['birthType'];
    $physicalAnomaly = $_POST['physicalAnomaly'];
    $anomalyDetails = $_POST['anomalyDetails'] ?? null;
    $childAddressNepali = $_POST['childAddressNepali'];
    $childAddressEnglish = $_POST['childAddressEnglish'];
    $grandfatherNameNepali = $_POST['grandfatherNameNepali'];
    $grandfatherNameEnglish = $_POST['grandfatherNameEnglish'];
    $fatherNameNepali = $_POST['fatherNameNepali'];
    $motherNameNepali = $_POST['motherNameNepali'];
    $fatherNameEnglish = $_POST['fatherNameEnglish'];
    $motherNameEnglish = $_POST['motherNameEnglish'];
    $fatherProvinceNepali = $_POST['fatherProvinceNepali'];
    $fatherProvinceEnglish = $_POST['fatherProvinceEnglish'];
    $motherProvinceNepali = $_POST['motherProvinceNepali'];
    $motherProvinceEnglish = $_POST['motherProvinceEnglish'];
    $fatherDistrictNepali = $_POST['fatherDistrictNepali'];
    $fatherDistrictEnglish = $_POST['fatherDistrictEnglish'];
    $motherDistrictNepali = $_POST['motherDistrictNepali'];
    $motherDistrictEnglish = $_POST['motherDistrictEnglish'];
    $fatherMunicipalityNepali = $_POST['fatherMunicipalityNepali'];
    $fatherMunicipalityEnglish = $_POST['fatherMunicipalityEnglish'];
    $motherMunicipalityNepali = $_POST['motherMunicipalityNepali'];
    $motherMunicipalityEnglish = $_POST['motherMunicipalityEnglish'];
    $fatherWardNepali = $_POST['fatherWardNepali'];
    $fatherWardEnglish = $_POST['fatherWardEnglish'];
    $motherWardNepali = $_POST['motherWardNepali'];
    $motherWardEnglish = $_POST['motherWardEnglish'];
    $fatherStreetNepali = $_POST['fatherStreetNepali'];
    $fatherStreetEnglish = $_POST['fatherStreetEnglish'];
    $motherStreetNepali = $_POST['motherStreetNepali'];
    $motherStreetEnglish = $_POST['motherStreetEnglish'];
    $fatherHouseNoNepali = $_POST['fatherHouseNoNepali'];
    $fatherHouseNoEnglish = $_POST['fatherHouseNoEnglish'];
    $motherHouseNoNepali = $_POST['motherHouseNoNepali'];
    $motherHouseNoEnglish = $_POST['motherHouseNoEnglish'];
    $fatherAge = $_POST['fatherAge'];
    $motherAge = $_POST['motherAge'];
    $fatherCountry = $_POST['fatherCountry'];
    $motherCountry = $_POST['motherCountry'];
    $fatherCitizenshipCountry = $_POST['fatherCitizenshipCountry'];
    $motherCitizenshipCountry = $_POST['motherCitizenshipCountry'];
    $fatherCitizenshipNo = $_POST['fatherCitizenshipNo'];
    $motherCitizenshipNo = $_POST['motherCitizenshipNo'];
    $fatherCitizenshipDate = $_POST['fatherCitizenshipDate'];
    $motherCitizenshipDate = $_POST['motherCitizenshipDate'];
    $fatherCitizenshipDistrict = $_POST['fatherCitizenshipDistrict'];
    $motherCitizenshipDistrict = $_POST['motherCitizenshipDistrict'];
    $fatherPassportNo = $_POST['fatherPassportNo'];
    $motherPassportNo = $_POST['motherPassportNo'];
    $fatherPassportCountry = $_POST['fatherPassportCountry'];
    $motherPassportCountry = $_POST['motherPassportCountry'];
    $fatherEducation = $_POST['fatherEducation'];
    $motherEducation = $_POST['motherEducation'];
    $fatherOccupation = $_POST['fatherOccupation'];
    $motherOccupation = $_POST['motherOccupation'];
    $fatherReligion = $_POST['fatherReligion'];
    $motherReligion = $_POST['motherReligion'];
    $fatherLanguage = $_POST['fatherLanguage'];
    $motherLanguage = $_POST['motherLanguage'];
    $totalBornChildren = $_POST['totalBornChildren'];
    $totalLivingChildren = $_POST['totalLivingChildren'];
    $marriageRegistrationNo = $_POST['marriageRegistrationNo'];
    $marriageRegistrationDate = $_POST['marriageRegistrationDate'];

    $informantNameNepali = $_POST['informantNameNepali'];
    $informantNameEnglish = $_POST['informantNameEnglish'];
    $relationshipToChild = $_POST['relationshipToChild'];
    $informantDistrict = $_POST['informantDistrict'];
    $informantMunicipality = $_POST['informantMunicipality'];
    $informantWard = $_POST['informantWard'];
    $informantStreet = $_POST['informantStreet'];
    $informantHouseNo = $_POST['informantHouseNo'];
    $informantCitizenshipNo = $_POST['informantCitizenshipNo'];
    $informantCitizenshipDate = $_POST['informantCitizenshipDate'];
    $informantCitizenshipDistrict = $_POST['informantCitizenshipDistrict'];
    $informantPassportNo = $_POST['informantPassportNo'];
    $informantPassportCountry = $_POST['informantPassportCountry'];

    // Handle file uploads
    $uploadDir = 'uploads/';
    $informantSignature = $uploadDir . basename($_FILES['informantSignature']['name']);
    $leftThumbPrint = $uploadDir . basename($_FILES['leftThumbPrint']['name']);
    $rightThumbPrint = $uploadDir . basename($_FILES['rightThumbPrint']['name']);

    if (
        move_uploaded_file($_FILES['informantSignature']['tmp_name'], $informantSignature) &&
        move_uploaded_file($_FILES['leftThumbPrint']['tmp_name'], $leftThumbPrint) &&
        move_uploaded_file($_FILES['rightThumbPrint']['tmp_name'], $rightThumbPrint)
    ) {

        // Generate a 6-digit alphanumeric token
        $token = 'B' . strtoupper(substr(md5(uniqid()), 0, 5));

        // Insert data into the database
        $query = "INSERT INTO birth_records (
            token, child_name_nepali, child_name_english, birth_date_bs, birth_date_ad, birth_place, birth_assistance, gender, 
            ethnicity, birth_weight, birth_type, physical_anomaly, anomaly_details, address_nepali, address_english, 
            grandfather_name_nepali, grandfather_name_english, father_name_nepali, mother_name_nepali, father_name_english, mother_name_english, 
            father_province_nepali, father_province_english, mother_province_nepali, mother_province_english, 
            father_district_nepali, father_district_english, mother_district_nepali, mother_district_english, 
            father_municipality_nepali, father_municipality_english, mother_municipality_nepali, mother_municipality_english, 
            father_ward_nepali, father_ward_english, mother_ward_nepali, mother_ward_english, 
            father_street_nepali, father_street_english, mother_street_nepali, mother_street_english, 
            father_house_no_nepali, father_house_no_english, mother_house_no_nepali, mother_house_no_english, 
            father_age, mother_age, father_country, mother_country, 
            father_citizenship_country, mother_citizenship_country, father_citizenship_no, mother_citizenship_no, 
            father_citizenship_date, mother_citizenship_date, father_citizenship_district, mother_citizenship_district, 
            father_passport_no, mother_passport_no, father_passport_country, mother_passport_country, 
            father_education, mother_education, father_occupation, mother_occupation, 
            father_religion, mother_religion, father_language, mother_language, 
            total_born_children, total_living_children, marriage_registration_no, marriage_registration_date, 
            informant_name_nepali, informant_name_english, relationship_to_child, 
            informant_district, informant_municipality, informant_ward, informant_street, informant_house_no, 
            informant_citizenship_no, informant_citizenship_date, informant_citizenship_district, 
            informant_passport_no, informant_passport_country, informant_signature, left_thumb_print, right_thumb_print
        ) VALUES (
            '$token', '$childNameNepali', '$childNameEnglish', '$birthDateBS', '$birthDateAD', '$birthPlace', '$birthAssistance', '$childGender', 
            '$ethnicity', '$birthWeight', '$birthType', '$physicalAnomaly', '$anomalyDetails', '$childAddressNepali', '$childAddressEnglish', 
            '$grandfatherNameNepali', '$grandfatherNameEnglish', '$fatherNameNepali', '$motherNameNepali', '$fatherNameEnglish', '$motherNameEnglish', 
            '$fatherProvinceNepali', '$fatherProvinceEnglish', '$motherProvinceNepali', '$motherProvinceEnglish', 
            '$fatherDistrictNepali', '$fatherDistrictEnglish', '$motherDistrictNepali', '$motherDistrictEnglish', 
            '$fatherMunicipalityNepali', '$fatherMunicipalityEnglish', '$motherMunicipalityNepali', '$motherMunicipalityEnglish', 
            '$fatherWardNepali', '$fatherWardEnglish', '$motherWardNepali', '$motherWardEnglish', 
            '$fatherStreetNepali', '$fatherStreetEnglish', '$motherStreetNepali', '$motherStreetEnglish', 
            '$fatherHouseNoNepali', '$fatherHouseNoEnglish', '$motherHouseNoNepali', '$motherHouseNoEnglish', 
            '$fatherAge', '$motherAge', '$fatherCountry', '$motherCountry', 
            '$fatherCitizenshipCountry', '$motherCitizenshipCountry', '$fatherCitizenshipNo', '$motherCitizenshipNo', 
            '$fatherCitizenshipDate', '$motherCitizenshipDate', '$fatherCitizenshipDistrict', '$motherCitizenshipDistrict', 
            '$fatherPassportNo', '$motherPassportNo', '$fatherPassportCountry', '$motherPassportCountry', 
            '$fatherEducation', '$motherEducation', '$fatherOccupation', '$motherOccupation', 
            '$fatherReligion', '$motherReligion', '$fatherLanguage', '$motherLanguage', 
            '$totalBornChildren', '$totalLivingChildren', '$marriageRegistrationNo', '$marriageRegistrationDate', 
            '$informantNameNepali', '$informantNameEnglish', '$relationshipToChild', 
            '$informantDistrict', '$informantMunicipality', '$informantWard', '$informantStreet', '$informantHouseNo', 
            '$informantCitizenshipNo', '$informantCitizenshipDate', '$informantCitizenshipDistrict', 
            '$informantPassportNo', '$informantPassportCountry', '$informantSignature', '$leftThumbPrint', '$rightThumbPrint'
        )";

        if (mysqli_query($conn, $query)) {

            echo "<div class='alert alert-success'>Form submitted successfully! Your token number is: <strong>$token</strong></div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>File upload failed!</div>";
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Birth Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="rm-bs.css">
</head>

<body>
    <div class="container my-5">
        <a href="index.php" class="btn btn-primary mb-3">Back to Home ( फिर्ता जानुहोस् )</a>
        <h1 class="text-center mb-4">जन्म दर्ता फारम</h1>
        <form method="POST" enctype="multipart/form-data">
            <!-- Newborn Details -->
            <!-- Section 1: Newborn Details -->
            <div class="mb-4">
                <h4>१. नवजात शिशुको विवरण</h4>

                <!-- Name Fields -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="childNameNepali" class="form-label">नाम (नेपालीमा)</label>
                        <input type="text" class="form-control" name="childNameNepali" placeholder="शिशुको नाम"
                            required />
                    </div>
                    <div class="col-md-6">
                        <label for="childNameEnglish" class="form-label">Full Name (In English)</label>
                        <input type="text" class="form-control" name="childNameEnglish" placeholder="Child's Full Name"
                            required />
                    </div>
                </div>

                <!-- Birth Date Fields -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="birthDateBS" class="form-label">जन्म मिति (वि.स.)</label>
                        <input type="date" class="form-control" name="birthDateBS" required />
                    </div>
                    <div class="col-md-6">
                        <label for="birthDateAD" class="form-label">जन्म मिति (ई.स.)</label>
                        <input type="date" class="form-control" name="birthDateAD" required />
                    </div>
                </div>

                <!-- Place of Birth -->
                <div class="mb-3">
                    <label for="birthPlace" class="form-label">शिशु जन्मेको स्थान</label>
                    <select class="form-select" name="birthPlace" required>
                        <option value="">Select</option>
                        <option value="home">घर</option>
                        <option value="health_institution">स्वास्थ्य संस्था</option>
                        <option value="hospital">अस्पताल</option>
                        <option value="other">अन्य</option>
                    </select>
                </div>

                <!-- Assistance During Birth -->
                <div class="mb-3">
                    <label for="birthAssistance" class="form-label">शिशु जन्मदा मद्दत गर्ने व्यक्ति</label>
                    <select class="form-select" name="birthAssistance" required>
                        <option value="">Select</option>
                        <option value="family">घरको मानिस</option>
                        <option value="health_worker">स्वास्थ्यकर्मी</option>
                        <option value="doctor">डाक्टर</option>
                        <option value="other">अन्य</option>
                    </select>
                </div>

                <!-- Gender and Ethnicity -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="childGender" class="form-label">लिङ्ग</label>
                        <select class="form-select" name="childGender" required>
                            <option value="">Select</option>
                            <option value="male">पुरुष</option>
                            <option value="female">महिला</option>
                            <option value="other">अन्य</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="ethnicity" class="form-label">जात/जाति</label>
                        <input type="text" class="form-control" name="ethnicity" placeholder="शिशुको जात/जाति" required />
                    </div>
                </div>

                <!-- Newborn's Weight -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="birthWeight" class="form-label">शिशु जन्मदा को तौल (के.जी.मा)</label>
                        <input type="number" class="form-control" name="birthWeight" placeholder="तौल (के.जी.मा)"
                            step="0.01" required>
                    </div>
                </div>


                <!-- Birth Type and Anomaly -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="birthType" class="form-label">जन्म प्रकार</label>
                        <select class="form-select" name="birthType" required>
                            <option value="">Select</option>
                            <option value="single">एकल</option>
                            <option value="twin">जुम्ल्याहा</option>
                            <option value="more">त्यसभन्दा बढी</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="physicalAnomaly" class="form-label">शारीरिक विकृति</label>
                        <select class="form-select" id="physicalAnomaly" name="physicalAnomaly" required onchange="showOtherReasonField()">
                            <option value="">Select</option>
                            <option value="yes">छ</option>
                            <option value="no">छैन</option>
                        </select>
                    </div>
                </div>

                <!-- Physical Anomaly Description -->
                <div class="mb-3" style="display: none" id="anomalyDetailsWrapper" name="anomalyDetailsWrapper">
                    <label for="anomalyDetails" class="form-label">कुनै शारीरिक विकृति भएमा उल्लेख
                        गर्नुहोस्</label>
                    <textarea class="form-control" id="anomalyDetails" name="anomalyDetails" rows="3"
                        placeholder="विवरण यहाँ लेख्नुहोस्"></textarea>
                </div>


                <!-- Address -->
                <div class="mb-3">
                    <label for="childAddressNepali" class="form-label">नवजात शिशुको ठेगाना (नेपालीमा)</label>
                    <input type="text" class="form-control" name="childAddressNepali"
                        placeholder="प्रदेश, जिल्ला, गा.वि.स./न.पा., वडा नं." required />
                </div>
                <div class="mb-3">
                    <label for="childAddressEnglish" class="form-label">नवजात शिशुको ठेगाना (In English)</label>
                    <input type="text" class="form-control" name="childAddressEnglish"
                        placeholder="Province, District, Municipality, Ward No." required />
                </div>
            </div>

            <!-- Section 2: Grandfather's Details -->
            <div class="mb-4">
                <h4>२. नवजात शिशुको बाजेको विवरण</h4>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="grandfatherNameNepali" class="form-label">बाजेको नाम (नेपालीमा)</label>
                        <input type="text" class="form-control" name="grandfatherNameNepali"
                            placeholder="बाजेको नाम (नेपालीमा)" required />
                    </div>
                    <div class="col-md-6">
                        <label for="grandfatherNameEnglish" class="form-label">Grandfather's Full Name (In
                            English)</label>
                        <input type="text" class="form-control" name="grandfatherNameEnglish"
                            placeholder="Grandfather's Full Name" required />
                    </div>
                </div>
            </div>

            <!-- Section 3: Father's and Mother's Details -->
            <div class="mb-4">
                <h4>३. नवजात शिशुको बाबु र आमाको विवरण</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>विवरण</th>
                                <th colspan="2">बाबुको विवरण</th>
                                <th colspan="2">आमाको विवरण</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Name -->
                            <tr>
                                <td>नाम (नेपालीमा)</td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="fatherNameNepali"
                                        placeholder="बाबुको नाम (नेपालीमा)" required />
                                </td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="motherNameNepali"
                                        placeholder="आमाको नाम (नेपालीमा)" required />
                                </td>
                            </tr>
                            <tr>
                                <td>Full Name (In English)</td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="fatherNameEnglish"
                                        placeholder="Father's Full Name" required />
                                </td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="motherNameEnglish"
                                        placeholder="Mother's Full Name" required />
                                </td>
                            </tr>

                            <!-- Address Breakdown -->
                            <!-- Province -->
                            <tr>
                                <td>प्रदेश</td>
                                <td>
                                    <input type="text" class="form-control" name="fatherProvinceNepali"
                                        placeholder="बाबुको प्रदेश (नेपालीमा)" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="fatherProvinceEnglish"
                                        placeholder="Father's Province (In English)" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="motherProvinceNepali"
                                        placeholder="आमाको प्रदेश (नेपालीमा)" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="motherProvinceEnglish"
                                        placeholder="Mother's Province (In English)" required>
                                </td>
                            </tr>
                            <tr>
                                <td>जिल्ला</td>
                                <td>
                                    <input type="text" class="form-control" name="fatherDistrictNepali"
                                        placeholder="बाबुको जिल्ला (नेपालीमा)" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="fatherDistrictEnglish"
                                        placeholder="Father's District (In English)" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="motherDistrictNepali"
                                        placeholder="आमाको जिल्ला (नेपालीमा)" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="motherDistrictEnglish"
                                        placeholder="Mother's District (In English)" required>
                                </td>
                            </tr>
                            <!-- Municipality -->
                            <tr>
                                <td>गा.वि.स./न.पा.</td>
                                <td>
                                    <input type="text" class="form-control" name="fatherMunicipalityNepali"
                                        placeholder="बाबुको गा.वि.स./न.पा. (नेपालीमा)" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="fatherMunicipalityEnglish"
                                        placeholder="Father's Municipality (In English)" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="motherMunicipalityNepali"
                                        placeholder="आमाको गा.वि.स./न.पा. (नेपालीमा)" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="motherMunicipalityEnglish"
                                        placeholder="Mother's Municipality (In English)" required>
                                </td>
                            </tr>
                            <!-- Ward Number -->
                            <tr>
                                <td>वडा नम्बर</td>
                                <td>
                                    <input type="number" class="form-control" name="fatherWardNepali"
                                        placeholder="बाबुको वडा नम्बर (नेपालीमा)" required>
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="fatherWardEnglish"
                                        placeholder="Father's Ward Number (In English)" required>
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="motherWardNepali"
                                        placeholder="आमाको वडा नम्बर (नेपालीमा)" required>
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="motherWardEnglish"
                                        placeholder="Mother's Ward Number (In English)" required>
                                </td>
                            </tr>
                            <!-- Street/Tole -->
                            <tr>
                                <td>सडक/टोल</td>
                                <td>
                                    <input type="text" class="form-control" name="fatherStreetNepali"
                                        placeholder="बाबुको सडक/टोल (नेपालीमा)">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="fatherStreetEnglish"
                                        placeholder="Father's Street/Tole (In English)">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="motherStreetNepali"
                                        placeholder="आमाको सडक/टोल (नेपालीमा)">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="motherStreetEnglish"
                                        placeholder="Mother's Street/Tole (In English)">
                                </td>
                            </tr>
                            <!-- House Number -->
                            <tr>
                                <td>घर नम्बर</td>
                                <td>
                                    <input type="text" class="form-control" name="fatherHouseNoNepali"
                                        placeholder="बाबुको घर नम्बर (नेपालीमा)">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="fatherHouseNoEnglish"
                                        placeholder="Father's House Number (In English)">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="motherHouseNoNepali"
                                        placeholder="आमाको घर नम्बर (नेपालीमा)">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="motherHouseNoEnglish"
                                        placeholder="Mother's House Number (In English)">
                                </td>
                            </tr>


                            <!-- Age at Childbirth -->
                            <tr>
                                <td>शिशु जन्मदा उमेर</td>
                                <td colspan="2">
                                    <input type="number" class="form-control" name="fatherAge"
                                        placeholder="बाबुको उमेर (शिशु जन्मदा)" required />
                                </td>
                                <td colspan="2">
                                    <input type="number" class="form-control" name="motherAge"
                                        placeholder="आमाको उमेर (शिशु जन्मदा)" required />
                                </td>
                            </tr>

                            <!-- Country of Birth -->
                            <tr>
                                <td>जन्म भएको देश</td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="fatherCountry"
                                        placeholder="बाबुको जन्म देश" required />
                                </td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="motherCountry"
                                        placeholder="आमाको जन्म देश" required />
                                </td>
                            </tr>

                            <!-- Citizenship Details -->
                            <tr>
                                <td>नागरिकता लिएको देश</td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="fatherCitizenshipCountry"
                                        placeholder="बाबुको नागरिकता देश" required />
                                </td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="motherCitizenshipCountry"
                                        placeholder="आमाको नागरिकता देश" required />
                                </td>
                            </tr>
                            <tr>
                                <td>नागरिकता प्रमाणपत्र नम्बर</td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="fatherCitizenshipNo"
                                        placeholder="बाबुको नागरिकता प्रमाणपत्र नम्बर" required />
                                </td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="motherCitizenshipNo"
                                        placeholder="आमाको नागरिकता प्रमाणपत्र नम्बर" required />
                                </td>
                            </tr>
                            <tr>
                                <td>प्रमाणपत्र जारी मिति</td>
                                <td colspan="2">
                                    <input type="date" class="form-control" name="fatherCitizenshipDate" required />
                                </td>
                                <td colspan="2">
                                    <input type="date" class="form-control" name="motherCitizenshipDate" required />
                                </td>
                            </tr>
                            <tr>
                                <td>प्रमाणपत्र जारी जिल्ला</td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="fatherCitizenshipDistrict"
                                        placeholder="बाबुको प्रमाणपत्र जारी जिल्ला" required />
                                </td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="motherCitizenshipDistrict"
                                        placeholder="आमाको प्रमाणपत्र जारी जिल्ला" required />
                                </td>
                            </tr>
                            <!-- Passport Details -->
                            <tr>
                                <td>विदेशी भएमा पासपोर्ट नम्बर</td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="fatherPassportNo"
                                        placeholder="बाबुको पासपोर्ट नम्बर" />
                                </td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="motherPassportNo"
                                        placeholder="आमाको पासपोर्ट नम्बर" />
                                </td>
                            </tr>
                            <tr>
                                <td>पासपोर्ट जारी देश</td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="fatherPassportCountry"
                                        placeholder="बाबुको पासपोर्ट देश" />
                                </td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="motherPassportCountry"
                                        placeholder="आमाको पासपोर्ट देश" />
                                </td>
                            </tr>

                            <!-- Education, Occupation, Religion, Language -->
                            <tr>
                                <td>शैक्षिक स्तर</td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="fatherEducation"
                                        placeholder="बाबुको शैक्षिक स्तर" required />
                                </td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="motherEducation"
                                        placeholder="आमाको शैक्षिक स्तर" required />
                                </td>
                            </tr>
                            <!-- Occupation -->
                            <tr>
                                <td>पेशा</td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="fatherOccupation"
                                        placeholder="बाबुको पेशा" required />
                                </td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="motherOccupation"
                                        placeholder="आमाको पेशा" required />
                                </td>
                            </tr>
                            <tr>
                                <td>धर्म</td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="fatherReligion"
                                        placeholder="बाबुको धर्म" required />
                                </td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="motherReligion" placeholder="आमाको धर्म"
                                        required />
                                </td>
                            </tr>
                            <tr>
                                <td>मातृभाषा</td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="fatherLanguage"
                                        placeholder="बाबुको मातृभाषा" required />
                                </td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="motherLanguage"
                                        placeholder="आमाको मातृभाषा" required />
                                </td>
                            </tr>

                            <!-- Number of Children -->
                            <tr>
                                <td>जन्मेको सन्तान संख्या</td>
                                <td colspan="4">
                                    <input type="number" class="form-control" name="totalBornChildren"
                                        placeholder="जन्मेको सन्तान संख्या" required />
                                </td>
                            </tr>
                            <tr>
                                <td>जिवित सन्तान संख्या</td>
                                <td colspan="4">
                                    <input type="number" class="form-control" name="totalLivingChildren"
                                        placeholder="जिवित सन्तान संख्या" required />
                                </td>
                            </tr>

                            <!-- Marriage Details -->
                            <tr>
                                <td>विवाह दर्ता नम्बर</td>
                                <td colspan="4">
                                    <input type="text" class="form-control" name="marriageRegistrationNo"
                                        placeholder="विवाह दर्ता नम्बर" required />
                                </td>
                            </tr>
                            <tr>
                                <td>विवाह दर्ता मिति</td>
                                <td colspan="4">
                                    <input type="date" class="form-control" name="marriageRegistrationDate" required />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Section 4: Informant's Information -->
            <div class="mb-4">
                <h4>४. सूचकको विवरण</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>विवरण</th>
                                <th>सूचकको विवरण</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Name -->
                            <tr>
                                <td>नाम (नेपालीमा)</td>
                                <td>
                                    <input type="text" class="form-control" name="informantNameNepali"
                                        placeholder="सूचकको नाम (नेपालीमा)" required />
                                </td>
                            </tr>
                            <tr>
                                <td>Full Name (In English)</td>
                                <td>
                                    <input type="text" class="form-control" name="informantNameEnglish"
                                        placeholder="Informant's Full Name" required />
                                </td>
                            </tr>

                            <!-- Relationship -->
                            <tr>
                                <td>नवजात शिशुसँगको नाता</td>
                                <td>
                                    <input type="text" class="form-control" name="relationshipToChild"
                                        placeholder="सूचकको नाता (उदाहरण: बुबा, आमा)" required />
                                </td>
                            </tr>

                            <!-- Address Breakdown -->
                            <tr>
                                <td>जिल्ला</td>
                                <td>
                                    <input type="text" class="form-control" name="informantDistrict" placeholder="जिल्ला"
                                        required />
                                </td>
                            </tr>
                            <tr>
                                <td>गा.वि.स./न.पा.</td>
                                <td>
                                    <input type="text" class="form-control" name="informantMunicipality"
                                        placeholder="गा.वि.स./न.पा." required />
                                </td>
                            </tr>
                            <tr>
                                <td>वडा नम्बर</td>
                                <td>
                                    <input type="number" class="form-control" name="informantWard" placeholder="वडा नम्बर"
                                        required />
                                </td>
                            </tr>
                            <tr>
                                <td>सडक/टोल</td>
                                <td>
                                    <input type="text" class="form-control" name="informantStreet"
                                        placeholder="सडक/टोल" />
                                </td>
                            </tr>
                            <tr>
                                <td>घर नम्बर</td>
                                <td>
                                    <input type="text" class="form-control" name="informantHouseNo"
                                        placeholder="घर नम्बर" />
                                </td>
                            </tr>

                            <!-- Citizenship Details -->
                            <tr>
                                <td>नागरिकता प्रमाणपत्र नम्बर</td>
                                <td>
                                    <input type="text" class="form-control" name="informantCitizenshipNo"
                                        placeholder="नागरिकता प्रमाणपत्र नम्बर" required />
                                </td>
                            </tr>
                            <tr>
                                <td>प्रमाणपत्र जारी मिति</td>
                                <td>
                                    <input type="date" class="form-control" name="informantCitizenshipDate" required />
                                </td>
                            </tr>
                            <tr>
                                <td>प्रमाणपत्र जारी जिल्ला</td>
                                <td>
                                    <input type="text" class="form-control" name="informantCitizenshipDistrict"
                                        placeholder="प्रमाणपत्र जारी जिल्ला" required />
                                </td>
                            </tr>

                            <!-- Passport Details (if applicable) -->
                            <tr>
                                <td>विदेशी भएमा पासपोर्ट नम्बर</td>
                                <td>
                                    <input type="text" class="form-control" name="informantPassportNo"
                                        placeholder="पासपोर्ट नम्बर" />
                                </td>
                            </tr>
                            <tr>
                                <td>पासपोर्ट जारी देश</td>
                                <td>
                                    <input type="text" class="form-control" name="informantPassportCountry"
                                        placeholder="पासपोर्ट जारी देश" />
                                </td>
                            </tr>

                            <!-- Signature and Thumbprints -->
                            <tr>
                                <td>सूचकको हस्ताक्षर</td>
                                <td>
                                    <input type="file" class="form-control" name="informantSignature"
                                        accept=".jpg, .png, .pdf" required />
                                </td>
                            </tr>
                            <tr>
                                <td>बायाँ औंठाको छाप</td>
                                <td>
                                    <input type="file" class="form-control" name="leftThumbPrint"
                                        accept=".jpg, .png, .pdf" required />
                                </td>
                            </tr>
                            <tr>
                                <td>दायाँ औंठाको छाप</td>
                                <td>
                                    <input type="file" class="form-control" name="rightThumbPrint"
                                        accept=".jpg, .png, .pdf" required />
                                </td>
                            </tr>

                            <!-- Current Date -->
                            <tr>
                                <td>मिति</td>
                                <td>
                                    <input type="text" class="form-control" name="currentDate" id="currentDate" placeholder="मिति"
                                        readonly />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Informant Confirmation -->
                <div class="form-check mt-3">
                    <input type="checkbox" class="form-check-input" name="informantConfirmation" required />
                    <label class="form-check-label" for="informantConfirmation">
                        यसमा दिएको विवरण साँचो हो। झुट्टा ठहरे कानुन बमोजिम सजाय भोग्न
                        तयार छु।
                    </label>
                </div>
            </div>

            <script>
                // Automatically populate the current date
                document.getElementById("currentDate").value =
                    new Date().toLocaleDateString("ne-NP");

                function showOtherReasonField() {
                    const anomalySelect = document.getElementById("physicalAnomaly");
                    const anomalyDetails = document.getElementById("anomalyDetails").parentElement;
                    if (anomalySelect.value === "yes") {
                        anomalyDetails.style.display = "block";
                    } else {
                        anomalyDetails.style.display = "none";
                    }
                }
            </script>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary">पेश गर्नुहोस् (Submit)</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>