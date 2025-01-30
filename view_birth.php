<?php
// Include database connection
include 'database.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If not logged in, disable the delete button
    $delete_disabled = true;
} else {
    $delete_disabled = false;
}

$token = mysqli_real_escape_string($conn, $_GET['token']);

$sql = "SELECT * FROM birth_records WHERE token = '$token'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    die("No data found for this token.");
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
                        <input type="text" class="form-control" name="childNameNepali" value="<?php echo htmlspecialchars($row['child_name_nepali']); ?>" readonly />
                    </div>
                    <div class="col-md-6">
                        <label for="childNameEnglish" class="form-label">Full Name (In English)</label>
                        <input type="text" class="form-control" name="childNameEnglish" value="<?php echo htmlspecialchars($row['child_name_english']); ?>" readonly />
                    </div>
                </div>

                <!-- Birth Date Fields -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="birthDateBS" class="form-label">जन्म मिति (वि.स.)</label>
                        <input type="date" class="form-control" name="birthDateBS" value="<?php echo htmlspecialchars($row['birth_date_bs']); ?>" readonly />
                    </div>
                    <div class="col-md-6">
                        <label for="birthDateAD" class="form-label">जन्म मिति (ई.स.)</label>
                        <input type="date" class="form-control" name="birthDateAD" value="<?php echo htmlspecialchars($row['birth_date_ad']); ?>" readonly />
                    </div>
                </div>

                <!-- Place of Birth -->
                <div class="mb-3">
                    <label for="birthPlace" class="form-label">शिशु जन्मेको स्थान</label>
                    <select class="form-select" name="birthPlace" disabled>
                        <option value="home" <?php echo ($row['birth_place'] == 'home') ? 'selected' : ''; ?>>घर</option>
                        <option value="health_institution" <?php echo ($row['birth_place'] == 'health_institution') ? 'selected' : ''; ?>>स्वास्थ्य संस्था</option>
                        <option value="hospital" <?php echo ($row['birth_place'] == 'hospital') ? 'selected' : ''; ?>>अस्पताल</option>
                        <option value="other" <?php echo ($row['birth_place'] == 'other') ? 'selected' : ''; ?>>अन्य</option>
                    </select>
                </div>

                <!-- Assistance During Birth -->
                <div class="mb-3">
                    <label for="birthAssistance" class="form-label">शिशु जन्मदा मद्दत गर्ने व्यक्ति</label>
                    <select class="form-select" name="birthAssistance" disabled>
                        <option value="family" <?php echo ($row['birth_assistance'] == 'family') ? 'selected' : ''; ?>>घरको मानिस</option>
                        <option value="health_worker" <?php echo ($row['birth_assistance'] == 'health_worker') ? 'selected' : ''; ?>>स्वास्थ्यकर्मी</option>
                        <option value="doctor" <?php echo ($row['birth_assistance'] == 'doctor') ? 'selected' : ''; ?>>डाक्टर</option>
                        <option value="other" <?php echo ($row['birth_assistance'] == 'other') ? 'selected' : ''; ?>>अन्य</option>
                    </select>
                </div>

                <!-- Gender and Ethnicity -->
                <div class="row mb-3">
                    <!-- Gender -->
                    <div class="mb-3">
                        <label for="childGender" class="form-label">लिङ्ग</label>
                        <select class="form-select" name="childGender" disabled>
                            <option value="male" <?php echo ($row['gender'] == 'male') ? 'selected' : ''; ?>>पुरुष</option>
                            <option value="female" <?php echo ($row['gender'] == 'female') ? 'selected' : ''; ?>>महिला</option>
                            <option value="other" <?php echo ($row['gender'] == 'other') ? 'selected' : ''; ?>>अन्य</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="ethnicity" class="form-label">जात/जाति</label>
                        <input type="text" class="form-control" name="ethnicity" value="<?php echo htmlspecialchars($row['ethnicity']); ?>" readonly />
                    </div>
                </div>

                <!-- Newborn's Weight -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="birthWeight" class="form-label">शिशु जन्मदा को तौल (के.जी.मा)</label>
                        <input type="number" class="form-control" name="birthWeight" value="<?php echo htmlspecialchars($row['birth_weight']); ?>" readonly />
                    </div>
                </div>

                <!-- Birth Type and Anomaly -->
                <div class="row mb-3">
                    <!-- Birth Type -->
                    <div class="mb-3">
                        <label for="birthType" class="form-label">जन्म प्रकार</label>
                        <select class="form-select" name="birthType" disabled>
                            <option value="single" <?php echo ($row['birth_type'] == 'single') ? 'selected' : ''; ?>>एकल</option>
                            <option value="twin" <?php echo ($row['birth_type'] == 'twin') ? 'selected' : ''; ?>>जुम्ल्याहा</option>
                            <option value="more" <?php echo ($row['birth_type'] == 'more') ? 'selected' : ''; ?>>त्यसभन्दा बढी</option>
                        </select>
                    </div>
                    <!-- Physical Anomaly -->
                    <div class="mb-3">
                        <label for="physicalAnomaly" class="form-label">शारीरिक विकृति</label>
                        <select class="form-select" id="physicalAnomaly" name="physicalAnomaly" disabled>
                            <option value="yes" <?php echo ($row['physical_anomaly'] == 'yes') ? 'selected' : ''; ?>>छ</option>
                            <option value="no" <?php echo ($row['physical_anomaly'] == 'no') ? 'selected' : ''; ?>>छैन</option>
                        </select>
                    </div>
                </div>

                <!-- Physical Anomaly Description -->
                <div class="mb-3">
                    <label for="anomalyDetails" class="form-label">कुनै शारीरिक विकृति भएमा उल्लेख गर्नुहोस्</label>
                    <textarea class="form-control" name="anomalyDetails" rows="3" readonly><?php echo htmlspecialchars($row['anomaly_details']); ?></textarea>
                </div>

                <!-- Address -->
                <div class="mb-3">
                    <label for="childAddressNepali" class="form-label">नवजात शिशुको ठेगाना (नेपालीमा)</label>
                    <input type="text" class="form-control" name="childAddressNepali" value="<?php echo htmlspecialchars($row['address_nepali']); ?>" readonly />
                </div>
                <div class="mb-3">
                    <label for="childAddressEnglish" class="form-label">Newborn's Address (In English)</label>
                    <input type="text" class="form-control" name="childAddressEnglish" value="<?php echo htmlspecialchars($row['address_english']); ?>" readonly />
                </div>
            </div>


            <!-- Section 2: Grandfather's Details -->
            <div class="mb-4">
                <h4>२. नवजात शिशुको बाजेको विवरण</h4>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="grandfatherNameNepali" class="form-label">बाजेको नाम (नेपालीमा)</label>
                        <input type="text" class="form-control" name="grandfatherNameNepali" value="<?php echo htmlspecialchars($row['grandfather_name_nepali']); ?>" readonly />
                    </div>
                    <div class="col-md-6">
                        <label for="grandfatherNameEnglish" class="form-label">Grandfather's Full Name (In English)</label>
                        <input type="text" class="form-control" name="grandfatherNameEnglish" value="<?php echo htmlspecialchars($row['grandfather_name_english']); ?>" readonly />
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
                                    <input type="text" class="form-control" name="fatherNameNepali" value="<?php echo htmlspecialchars($row['father_name_nepali']); ?>" readonly />
                                </td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="motherNameNepali" value="<?php echo htmlspecialchars($row['mother_name_nepali']); ?>" readonly />
                                </td>
                            </tr>
                            <tr>
                                <td>Full Name (In English)</td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="fatherNameEnglish" value="<?php echo htmlspecialchars($row['father_name_english']); ?>" readonly />
                                </td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="motherNameEnglish" value="<?php echo htmlspecialchars($row['mother_name_english']); ?>" readonly />
                                </td>
                            </tr>

                            <!-- Address Breakdown -->
                            <!-- Province -->
                            <tr>
                                <td>प्रदेश</td>
                                <td>
                                    <input type="text" class="form-control" name="fatherProvinceNepali" value="<?php echo htmlspecialchars($row['father_province_nepali']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="fatherProvinceEnglish" value="<?php echo htmlspecialchars($row['father_province_english']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="motherProvinceNepali" value="<?php echo htmlspecialchars($row['mother_province_nepali']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="motherProvinceEnglish" value="<?php echo htmlspecialchars($row['mother_province_english']); ?>" readonly />
                                </td>
                            </tr>
                            <tr>
                                <td>जिल्ला</td>
                                <td>
                                    <input type="text" class="form-control" name="fatherDistrictNepali" value="<?php echo htmlspecialchars($row['father_district_nepali']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="fatherDistrictEnglish" value="<?php echo htmlspecialchars($row['father_district_english']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="motherDistrictNepali" value="<?php echo htmlspecialchars($row['mother_district_nepali']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="motherDistrictEnglish" value="<?php echo htmlspecialchars($row['mother_district_english']); ?>" readonly />
                                </td>
                            </tr>
                            <!-- Municipality -->
                            <tr>
                                <td>गा.वि.स./न.पा.</td>
                                <td>
                                    <input type="text" class="form-control" name="fatherMunicipalityNepali" value="<?php echo htmlspecialchars($row['father_municipality_nepali']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="fatherMunicipalityEnglish" value="<?php echo htmlspecialchars($row['father_municipality_english']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="motherMunicipalityNepali" value="<?php echo htmlspecialchars($row['mother_municipality_nepali']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="motherMunicipalityEnglish" value="<?php echo htmlspecialchars($row['mother_municipality_english']); ?>" readonly />
                                </td>
                            </tr>
                            <!-- Ward Number -->
                            <tr>
                                <td>वडा नम्बर</td>
                                <td>
                                    <input type="number" class="form-control" name="fatherWardNepali" value="<?php echo htmlspecialchars($row['father_ward_nepali']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="fatherWardEnglish" value="<?php echo htmlspecialchars($row['father_ward_english']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="motherWardNepali" value="<?php echo htmlspecialchars($row['mother_ward_nepali']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="motherWardEnglish" value="<?php echo htmlspecialchars($row['mother_ward_english']); ?>" readonly />
                                </td>
                            </tr>
                            <!-- Street/Tole -->
                            <tr>
                                <td>सडक/टोल</td>
                                <td>
                                    <input type="text" class="form-control" name="fatherStreetNepali" value="<?php echo htmlspecialchars($row['father_street_nepali']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="fatherStreetEnglish" value="<?php echo htmlspecialchars($row['father_street_english']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="motherStreetNepali" value="<?php echo htmlspecialchars($row['mother_street_nepali']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="motherStreetEnglish" value="<?php echo htmlspecialchars($row['mother_street_english']); ?>" readonly />
                                </td>
                            </tr>
                            <!-- House Number -->
                            <tr>
                                <td>घर नम्बर</td>
                                <td>
                                    <input type="text" class="form-control" name="fatherHouseNoNepali" value="<?php echo htmlspecialchars($row['father_house_no_nepali']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="fatherHouseNoEnglish" value="<?php echo htmlspecialchars($row['father_house_no_english']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="motherHouseNoNepali" value="<?php echo htmlspecialchars($row['mother_house_no_nepali']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="motherHouseNoEnglish" value="<?php echo htmlspecialchars($row['mother_house_no_english']); ?>" readonly />
                                </td>
                            </tr>

                            <tr>
                                <td>शिशु जन्मदा उमेर</td>
                                <td colspan="2">
                                    <input type="number" class="form-control" name="fatherAge" value="<?php echo htmlspecialchars($row['father_age']); ?>" readonly />
                                </td>
                                <td colspan="2">
                                    <input type="number" class="form-control" name="motherAge" value="<?php echo htmlspecialchars($row['mother_age']); ?>" readonly />
                                </td>
                            </tr>
                            <tr>
                                <td>जन्म भएको देश</td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="fatherCountry" value="<?php echo htmlspecialchars($row['father_country']); ?>" readonly />
                                </td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="motherCountry" value="<?php echo htmlspecialchars($row['mother_country']); ?>" readonly />
                                </td>
                            </tr>

                            <!-- Citizenship Details -->
                            <tr>
                                <td>नागरिकता लिएको देश</td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="fatherCitizenshipCountry"
                                        value="<?php echo htmlspecialchars($row['father_citizenship_country']); ?>" required />
                                </td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="motherCitizenshipCountry"
                                        value="<?php echo htmlspecialchars($row['mother_citizenship_country']); ?>" required />
                                </td>
                            </tr>
                            <tr>
                                <td>नागरिकता प्रमाणपत्र नम्बर</td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="fatherCitizenshipNo"
                                        value="<?php echo htmlspecialchars($row['father_citizenship_no']); ?>" required />
                                </td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="motherCitizenshipNo"
                                        value="<?php echo htmlspecialchars($row['mother_citizenship_no']); ?>" required />
                                </td>
                            </tr>
                            <tr>
                                <td>प्रमाणपत्र जारी मिति</td>
                                <td colspan="2">
                                    <input type="date" class="form-control" name="fatherCitizenshipDate"
                                        value="<?php echo htmlspecialchars($row['father_citizenship_date']); ?>" required />
                                </td>
                                <td colspan="2">
                                    <input type="date" class="form-control" name="motherCitizenshipDate"
                                        value="<?php echo htmlspecialchars($row['mother_citizenship_date']); ?>" required />
                                </td>
                            </tr>
                            <tr>
                                <td>प्रमाणपत्र जारी जिल्ला</td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="fatherCitizenshipDistrict"
                                        value="<?php echo htmlspecialchars($row['father_citizenship_district']); ?>" required />
                                </td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="motherCitizenshipDistrict"
                                        value="<?php echo htmlspecialchars($row['mother_citizenship_district']); ?>" required />
                                </td>
                            </tr>

                            <!-- Passport Details -->
                            <tr>
                                <td>विदेशी भएमा पासपोर्ट नम्बर</td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="fatherPassportNo"
                                        value="<?php echo htmlspecialchars($row['father_passport_no']); ?>" />
                                </td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="motherPassportNo"
                                        value="<?php echo htmlspecialchars($row['mother_passport_no']); ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>पासपोर्ट जारी देश</td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="fatherPassportCountry"
                                        value="<?php echo htmlspecialchars($row['father_passport_country']); ?>" />
                                </td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="motherPassportCountry"
                                        value="<?php echo htmlspecialchars($row['mother_passport_country']); ?>" />
                                </td>
                            </tr>

                            <!-- Education, Occupation, Religion, Language -->
                            <tr>
                                <td>शैक्षिक स्तर</td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="fatherEducation"
                                        value="<?php echo htmlspecialchars($row['father_education']); ?>" required />
                                </td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="motherEducation"
                                        value="<?php echo htmlspecialchars($row['mother_education']); ?>" required />
                                </td>
                            </tr>
                            <!-- Occupation -->
                            <tr>
                                <td>पेशा</td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="fatherOccupation"
                                        value="<?php echo htmlspecialchars($row['father_occupation']); ?>" required />
                                </td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="motherOccupation"
                                        value="<?php echo htmlspecialchars($row['mother_occupation']); ?>" required />
                                </td>
                            </tr>
                            <tr>
                                <td>धर्म</td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="fatherReligion"
                                        value="<?php echo htmlspecialchars($row['father_religion']); ?>" required />
                                </td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="motherReligion"
                                        value="<?php echo htmlspecialchars($row['mother_religion']); ?>" required />
                                </td>
                            </tr>
                            <tr>
                                <td>मातृभाषा</td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="fatherLanguage"
                                        value="<?php echo htmlspecialchars($row['father_language']); ?>" required />
                                </td>
                                <td colspan="2">
                                    <input type="text" class="form-control" name="motherLanguage"
                                        value="<?php echo htmlspecialchars($row['mother_language']); ?>" required />
                                </td>
                            </tr>

                            <!-- Number of Children -->
                            <tr>
                                <td>जन्मेको सन्तान संख्या</td>
                                <td colspan="4">
                                    <input type="number" class="form-control" name="totalBornChildren"
                                        value="<?php echo htmlspecialchars($row['total_born_children']); ?>" required />
                                </td>
                            </tr>
                            <tr>
                                <td>जिवित सन्तान संख्या</td>
                                <td colspan="4">
                                    <input type="number" class="form-control" name="totalLivingChildren"
                                        value="<?php echo htmlspecialchars($row['total_living_children']); ?>" required />
                                </td>
                            </tr>

                            <!-- Marriage Details -->
                            <tr>
                                <td>विवाह दर्ता नम्बर</td>
                                <td colspan="4">
                                    <input type="text" class="form-control" name="marriageRegistrationNo"
                                        value="<?php echo htmlspecialchars($row['marriage_registration_no']); ?>" required />
                                </td>
                            </tr>
                            <tr>
                                <td>विवाह दर्ता मिति</td>
                                <td colspan="4">
                                    <input type="date" class="form-control" name="marriageRegistrationDate"
                                        value="<?php echo htmlspecialchars($row['marriage_registration_date']); ?>" required />
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
                                        value="<?php echo htmlspecialchars($row['informant_name_nepali']); ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>Full Name (In English)</td>
                                <td>
                                    <input type="text" class="form-control" name="informantNameEnglish"
                                        value="<?php echo htmlspecialchars($row['informant_name_english']); ?>" />
                                </td>
                            </tr>

                            <!-- Relationship -->
                            <tr>
                                <td>नवजात शिशुसँगको नाता</td>
                                <td>
                                    <input type="text" class="form-control" name="relationshipToChild"
                                        value="<?php echo htmlspecialchars($row['relationship_to_child']); ?>" />
                                </td>
                            </tr>

                            <!-- Address Breakdown -->
                            <tr>
                                <td>जिल्ला</td>
                                <td>
                                    <input type="text" class="form-control" name="informantDistrict"
                                        value="<?php echo htmlspecialchars($row['informant_district']); ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>गा.वि.स./न.पा.</td>
                                <td>
                                    <input type="text" class="form-control" name="informantMunicipality"
                                        value="<?php echo htmlspecialchars($row['informant_municipality']); ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>वडा नम्बर</td>
                                <td>
                                    <input type="number" class="form-control" name="informantWard"
                                        value="<?php echo htmlspecialchars($row['informant_ward']); ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>सडक/टोल</td>
                                <td>
                                    <input type="text" class="form-control" name="informantStreet"
                                        value="<?php echo htmlspecialchars($row['informant_street']); ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>घर नम्बर</td>
                                <td>
                                    <input type="text" class="form-control" name="informantHouseNo"
                                        value="<?php echo htmlspecialchars($row['informant_house_no']); ?>" />
                                </td>
                            </tr>

                            <!-- Citizenship Details -->
                            <tr>
                                <td>नागरिकता प्रमाणपत्र नम्बर</td>
                                <td>
                                    <input type="text" class="form-control" name="informantCitizenshipNo"
                                        value="<?php echo htmlspecialchars($row['informant_citizenship_no']); ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>प्रमाणपत्र जारी मिति</td>
                                <td>
                                    <input type="date" class="form-control" name="informantCitizenshipDate"
                                        value="<?php echo htmlspecialchars($row['informant_citizenship_date']); ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>प्रमाणपत्र जारी जिल्ला</td>
                                <td>
                                    <input type="text" class="form-control" name="informantCitizenshipDistrict"
                                        value="<?php echo htmlspecialchars($row['informant_citizenship_district']); ?>" />
                                </td>
                            </tr>

                            <!-- Passport Details (if applicable) -->
                            <tr>
                                <td>विदेशी भएमा पासपोर्ट नम्बर</td>
                                <td>
                                    <input type="text" class="form-control" name="informantPassportNo"
                                        value="<?php echo htmlspecialchars($row['informant_passport_no']); ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>पासपोर्ट जारी देश</td>
                                <td>
                                    <input type="text" class="form-control" name="informantPassportCountry"
                                        value="<?php echo htmlspecialchars($row['informant_passport_country']); ?>" />
                                </td>
                            </tr>

                            <!-- Signature and Thumbprints -->
                            <tr>
                                <td>सूचकको हस्ताक्षर</td>
                                <td>
                                    <a href="download.php?token=<?php echo urlencode($token) ?>&file=informant_signature&table=birth_records" class="btn btn-secondary">Download</a>
                                </td>
                            </tr>
                            <tr>
                                <td>बायाँ औंठाको छाप</td>
                                <td>
                                    <a href="download.php?token=<?php echo urlencode($token) ?>&file=left_thumb_print&table=birth_records" class="btn btn-secondary">Download</a>
                                </td>
                            </tr>
                            <tr>
                                <td>दायाँ औंठाको छाप</td>
                                <td>
                                    <a href="download.php?token=<?php echo urlencode($token) ?>&file=right_thumb_print&table=birth_records" class="btn btn-secondary">Download</a>
                                </td>
                            </tr>

                            <!-- Current Date -->
                            <tr>
                                <td>मिति</td>
                                <td>
                                    <input type="text" class="form-control" name="currentDate" id="currentDate"
                                        value="<?php echo date('Y-m-d'); ?>" placeholder="मिति" readonly />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Informant Confirmation -->
                <div class="form-check mt-3">
                    <input type="checkbox" class="form-check-input" name="informantConfirmation" checked />
                    <label class="form-check-label" for="informantConfirmation">
                        यसमा दिएको विवरण साँचो हो। झुट्टा ठहरे कानुन बमोजिम सजाय भोग्न
                        तयार छु।
                    </label>
                </div>
            </div>
        </form>

        <!-- Delete Button (conditionally disabled) -->
        <a href="<?php echo $delete_disabled ? '#' : 'birth_delete.php?token=' . $token; ?>"
            class="btn btn-danger <?php echo $delete_disabled ? 'disabled' : ''; ?>"
            <?php echo $delete_disabled ? 'tabindex="-1" aria-disabled="true" style="pointer-events: none;"' : ''; ?>>
            Delete
        </a>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script>
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
    </script> -->
</body>

</html>