<?php
// Include database connection
include 'database.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Main migration details
    $migrationDate = $_POST['migrationDate'];
    $migrationReason = $_POST['migrationReason'];
    $otherReason = $_POST['otherReason'] ?? null;

    // Current and New Address Details
    $currentProvince = $_POST['currentProvince'];
    $currentProvinceEn = $_POST['currentProvinceEn'];
    $newProvince = $_POST['newProvince'];
    $newProvinceEn = $_POST['newProvinceEn'];
    $currentDistrict = $_POST['currentDistrict'];
    $currentDistrictEn = $_POST['currentDistrictEn'];
    $newDistrict = $_POST['newDistrict'];
    $newDistrictEn = $_POST['newDistrictEn'];
    $currentMunicipality = $_POST['currentMunicipality'];
    $currentMunicipalityEn = $_POST['currentMunicipalityEn'];
    $newMunicipality = $_POST['newMunicipality'];
    $newMunicipalityEn = $_POST['newMunicipalityEn'];
    $currentWard = $_POST['currentWard'];
    $currentWardEn = $_POST['currentWardEn'];
    $newWard = $_POST['newWard'];
    $newWardEn = $_POST['newWardEn'];
    $currentStreet = $_POST['currentStreet'];
    $currentStreetEn = $_POST['currentStreetEn'];
    $newStreet = $_POST['newStreet'];
    $newStreetEn = $_POST['newStreetEn'];
    $currentVillage = $_POST['currentVillage'];
    $currentVillageEn = $_POST['currentVillageEn'];
    $newVillage = $_POST['newVillage'];
    $newVillageEn = $_POST['newVillageEn'];
    $currentHouse = $_POST['currentHouse'];
    $currentHouseEn = $_POST['currentHouseEn'];
    $newHouse = $_POST['newHouse'];
    $newHouseEn = $_POST['newHouseEn'];

    // Informant Details
    $informantNameNepali = $_POST['informantNameNepali'];
    $informantNameEnglish = $_POST['informantNameEnglish'];
    $informantDistrict = $_POST['informantDistrict'];
    $informantMunicipality = $_POST['informantMunicipality'];
    $informantWard = $_POST['informantWard'];
    $informantStreet = $_POST['informantStreet'];
    $informantHouseNo = $_POST['informantHouseNo'];
    $informantCitizenshipNo = $_POST['informantCitizenshipNo'];
    $informantCitizenshipDate = $_POST['informantCitizenshipDate'];
    $informantCitizenshipDistrict = $_POST['informantCitizenshipDistrict'];
    $informantPassportNo = $_POST['informantPassportNo'] ?? null;
    $informantPassportCountry = $_POST['informantPassportCountry'] ?? null;

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
        $token = 'M' . strtoupper(substr(md5(uniqid()), 0, 5));

        // Insert migration record into migration_records table
        $query = "INSERT INTO migration_records (
            token, migration_date, migration_reason, other_reason, 
            current_province, current_province_en, current_district, current_district_en, 
            current_municipality, current_municipality_en, current_ward, current_ward_en, 
            current_street, current_street_en, current_village, current_village_en, 
            current_house, current_house_en, new_province, new_province_en, 
            new_district, new_district_en, new_municipality, new_municipality_en, 
            new_ward, new_ward_en, new_street, new_street_en, new_village, new_village_en, 
            new_house, new_house_en, informant_name_nepali, informant_name_english, 
            informant_district, informant_municipality, informant_ward, informant_street, 
            informant_house_no, informant_citizenship_no, informant_citizenship_date, 
            informant_citizenship_district, informant_passport_no, informant_passport_country, 
            informant_signature, left_thumb_print, right_thumb_print
        ) VALUES (
            '$token', '$migrationDate', '$migrationReason', '$otherReason', 
            '$currentProvince', '$currentProvinceEn', '$currentDistrict', '$currentDistrictEn', 
            '$currentMunicipality', '$currentMunicipalityEn', '$currentWard', '$currentWardEn', 
            '$currentStreet', '$currentStreetEn', '$currentVillage', '$currentVillageEn', 
            '$currentHouse', '$currentHouseEn', '$newProvince', '$newProvinceEn', 
            '$newDistrict', '$newDistrictEn', '$newMunicipality', '$newMunicipalityEn', 
            '$newWard', '$newWardEn', '$newStreet', '$newStreetEn', '$newVillage', '$newVillageEn', 
            '$newHouse', '$newHouseEn', '$informantNameNepali', '$informantNameEnglish', 
            '$informantDistrict', '$informantMunicipality', '$informantWard', '$informantStreet', 
            '$informantHouseNo', '$informantCitizenshipNo', '$informantCitizenshipDate', 
            '$informantCitizenshipDistrict', '$informantPassportNo', '$informantPassportCountry', 
            '$informantSignature', '$leftThumbPrint', '$rightThumbPrint'
        )";

        if (mysqli_query($conn, $query)) {
            $migrationId = mysqli_insert_id($conn); // Get the inserted migration record ID


            // Family Member Details
            $familyFullNameNepali = $_POST['fullNameNepali'] ?? [];
            $familyBirthRegNoNepali = $_POST['birthRegNoNepali'] ?? [];
            $familyDobNepali = $_POST['dobNepali'] ?? [];
            $familyGenderNepali = $_POST['genderNepali'] ?? [];
            $familyCitizenNoNepali = $_POST['citizenNoNepali'] ?? [];
            $familyIssueDateNepali = $_POST['issueDateNepali'] ?? [];
            $familyIssueDistrictNepali = $_POST['issueDistrictNepali'] ?? [];
            $familyRelationNepali = $_POST['relationNepali'] ?? [];

            $familyFullNameEnglish = $_POST['fullNameEnglish'] ?? [];
            $familyBirthRegNoEnglish = $_POST['birthRegNoEnglish'] ?? [];
            $familyDobEnglish = $_POST['dobEnglish'] ?? [];
            $familyGenderEnglish = $_POST['genderEnglish'] ?? [];
            $familyCitizenNoEnglish = $_POST['citizenNoEnglish'] ?? [];
            $familyIssueDateEnglish = $_POST['issueDateEnglish'] ?? [];
            $familyIssueDistrictEnglish = $_POST['issueDistrictEnglish'] ?? [];
            $familyRelationEnglish = $_POST['relationEnglish'] ?? [];

            // Ensure all family-related inputs are arrays
            $familyFullNameNepali = is_array($familyFullNameNepali) ? $familyFullNameNepali : [$familyFullNameNepali];
            $familyBirthRegNoNepali = is_array($familyBirthRegNoNepali) ? $familyBirthRegNoNepali : [$familyBirthRegNoNepali];
            $familyDobNepali = is_array($familyDobNepali) ? $familyDobNepali : [$familyDobNepali];
            $familyGenderNepali = is_array($familyGenderNepali) ? $familyGenderNepali : [$familyGenderNepali];
            $familyCitizenNoNepali = is_array($familyCitizenNoNepali) ? $familyCitizenNoNepali : [$familyCitizenNoNepali];
            $familyIssueDateNepali = is_array($familyIssueDateNepali) ? $familyIssueDateNepali : [$familyIssueDateNepali];
            $familyIssueDistrictNepali = is_array($familyIssueDistrictNepali) ? $familyIssueDistrictNepali : [$familyIssueDistrictNepali];
            $familyRelationNepali = is_array($familyRelationNepali) ? $familyRelationNepali : [$familyRelationNepali];

            // Ensure all family-related inputs are arrays
            $familyFullNameEnglish = is_array($familyFullNameEnglish) ? $familyFullNameEnglish : [$familyFullNameEnglish];
            $familyBirthRegNoEnglish = is_array($familyBirthRegNoEnglish) ? $familyBirthRegNoEnglish : [$familyBirthRegNoEnglish];
            $familyDobEnglish = is_array($familyDobEnglish) ? $familyDobEnglish : [$familyDobEnglish];
            $familyGenderEnglish = is_array($familyGenderEnglish) ? $familyGenderEnglish : [$familyGenderEnglish];
            $familyCitizenNoEnglish = is_array($familyCitizenNoEnglish) ? $familyCitizenNoEnglish : [$familyCitizenNoEnglish];
            $familyIssueDateEnglish = is_array($familyIssueDateEnglish) ? $familyIssueDateEnglish : [$familyIssueDateEnglish];
            $familyIssueDistrictEnglish = is_array($familyIssueDistrictEnglish) ? $familyIssueDistrictEnglish : [$familyIssueDistrictEnglish];
            $familyRelationEnglish = is_array($familyRelationEnglish) ? $familyRelationEnglish : [$familyRelationEnglish];

            // Insert family member details
            $familyQuery = "INSERT INTO family_members (
        migration_id, full_name_nepali, full_name_english, 
        birth_reg_no_nepali, birth_reg_no_english, 
        dob_nepali, dob_english, 
        gender_nepali, gender_english, 
        citizen_no_nepali, citizen_no_english, 
        issue_date_nepali, issue_date_english, 
        issue_district_nepali, issue_district_english, 
        relation_nepali, relation_english
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($familyQuery);

            // Loop through each family member and bind parameters
            foreach ($familyFullNameNepali as $index => $fullNameNepali) {
                // Initialize variables for optional values
                $fullNameEnglish = $familyFullNameEnglish[$index] ?? null;
                $birthRegNoNepali = $familyBirthRegNoNepali[$index] ?? null;
                $birthRegNoEnglish = $familyBirthRegNoEnglish[$index] ?? null;
                $dobNepali = $familyDobNepali[$index] ?? null;
                $dobEnglish = $familyDobEnglish[$index] ?? null;
                $genderNepali = $familyGenderNepali[$index] ?? null;
                $genderEnglish = $familyGenderEnglish[$index] ?? null;
                $citizenNoNepali = $familyCitizenNoNepali[$index] ?? null;
                $citizenNoEnglish = $familyCitizenNoEnglish[$index] ?? null;
                $issueDateNepali = $familyIssueDateNepali[$index] ?? null;
                $issueDateEnglish = $familyIssueDateEnglish[$index] ?? null;
                $issueDistrictNepali = $familyIssueDistrictNepali[$index] ?? null;
                $issueDistrictEnglish = $familyIssueDistrictEnglish[$index] ?? null;
                $relationNepali = $familyRelationNepali[$index] ?? null;
                $relationEnglish = $familyRelationEnglish[$index] ?? null;

                // Now bind parameters
                $stmt->bind_param(
                    "issssssssssssssss",
                    $migrationId,
                    $fullNameNepali,
                    $fullNameEnglish,
                    $birthRegNoNepali,
                    $birthRegNoEnglish,
                    $dobNepali,
                    $dobEnglish,
                    $genderNepali,
                    $genderEnglish,
                    $citizenNoNepali,
                    $citizenNoEnglish,
                    $issueDateNepali,
                    $issueDateEnglish,
                    $issueDistrictNepali,
                    $issueDistrictEnglish,
                    $relationNepali,
                    $relationEnglish
                );
                $stmt->execute();
            }



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
    <title>बसाईसराई दर्ता फारम</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="rm-bs.css">
</head>

<body>
    <div class="container py-5">
        <a href="index.php" class="btn btn-primary mb-3">Back to Home ( फिर्ता जानुहोस् )</a>
        <h1 class="text-center mb-4">बसाईसराई दर्ता फारम</h1>
        <form method="POST" enctype="multipart/form-data">
            <!-- Combined Table for Section 1 and 2 -->
            <div class="mb-4">
                <h3>
                    कहाँ सर्ने र कहाँबाट सरेको ठेगाना (Present and Migrated Address)
                </h3>
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>विवरण (Details)</th>
                            <th>हालको ठेगाना (Current Address - नेपाली)</th>
                            <th>Current Address (English)</th>
                            <th>नयाँ ठेगाना (New Address - नेपाली)</th>
                            <th>New Address (English)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>प्रदेश (Province)</td>
                            <td>
                                <input type="text" class="form-control" name="currentProvince" placeholder="प्रदेश" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="currentProvinceEn"
                                    placeholder="Province" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="newProvince" placeholder="प्रदेश" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="newProvinceEn" placeholder="Province" />
                            </td>
                        </tr>
                        <tr>
                            <td>जिल्ला (District)</td>
                            <td>
                                <input type="text" class="form-control" name="currentDistrict" placeholder="जिल्ला" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="currentDistrictEn"
                                    placeholder="District" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="newDistrict" placeholder="जिल्ला" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="newDistrictEn" placeholder="District" />
                            </td>
                        </tr>
                        <tr>
                            <td>गा.वि.स./न.पा. (Municipality)</td>
                            <td>
                                <input type="text" class="form-control" name="currentMunicipality"
                                    placeholder="गा.वि.स./न.पा." />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="currentMunicipalityEn"
                                    placeholder="Municipality" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="newMunicipality"
                                    placeholder="गा.वि.स./न.पा." />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="newMunicipalityEn"
                                    placeholder="Municipality" />
                            </td>
                        </tr>
                        <tr>
                            <td>वडा नं. (Ward No.)</td>
                            <td>
                                <input type="number" class="form-control" name="currentWard" placeholder="वडा नं." />
                            </td>
                            <td>
                                <input type="number" class="form-control" name="currentWardEn" placeholder="Ward No." />
                            </td>
                            <td>
                                <input type="number" class="form-control" name="newWard" placeholder="वडा नं." />
                            </td>
                            <td>
                                <input type="number" class="form-control" name="newWardEn" placeholder="Ward No." />
                            </td>
                        </tr>
                        <tr>
                            <td>सडक/मार्ग (Street/Area)</td>
                            <td>
                                <input type="text" class="form-control" name="currentStreet" placeholder="सडक/मार्ग" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="currentStreetEn"
                                    placeholder="Street/Area" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="newStreet" placeholder="सडक/मार्ग" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="newStreetEn" placeholder="Street/Area" />
                            </td>
                        </tr>
                        <tr>
                            <td>गाउँ/टोल (Village/Tole)</td>
                            <td>
                                <input type="text" class="form-control" name="currentVillage" placeholder="गाउँ/टोल" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="currentVillageEn"
                                    placeholder="Village/Tole" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="newVillage" placeholder="गाउँ/टोल" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="newVillageEn"
                                    placeholder="Village/Tole" />
                            </td>
                        </tr>
                        <tr>
                            <td>घर नं. (House No.)</td>
                            <td>
                                <input type="text" class="form-control" name="currentHouse" placeholder="घर नं." />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="currentHouseEn" placeholder="House No." />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="newHouse" placeholder="घर नं." />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="newHouseEn" placeholder="House No." />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Additional Fields -->
            <div class="mb-4">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="migrationDate" class="form-label">बसाई सराइ गरेको मिति (Migration Date)</label>
                        <input type="date" class="form-control" id="migrationDate" name="migrationDate" />
                    </div>
                    <div class="col-md-6">
                        <label for="migrationReason" class="form-label">बसाई सराइ गरेको कारण (Reason for
                            Migration)</label>
                        <select class="form-select" id="migrationReason" name="migrationReason"
                            onchange="showOtherReasonField()">
                            <option value="" selected disabled>छान्नुहोस्...</option>
                            <option value="job">नोकरी (Job)</option>
                            <option value="business">व्यापार/व्यवसाय (Business)</option>
                            <option value="housing">घर फास (Housing)</option>
                            <option value="education">शिक्षा (Education)</option>
                            <option value="other">अन्य (Other)</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3" id="otherReasonField" style="display: none">
                    <div class="col-md-12">
                        <label for="otherReason" class="form-label">अन्य कारण उल्लेख गर्नुहोस् (Specify Other
                            Reason)</label>
                        <input type="text" class="form-control" id="otherReason" name="otherReason"
                            placeholder="अन्य कारण" />
                    </div>
                </div>
            </div>

            <!-- Section: Family Member Details -->
            <div class="mb-4">
                <h3>परिवारका सदस्यको विवरण (Family Member Details)</h3>
                <table class="table table-bordered" id="familyTable">
                    <thead class="table-light">
                        <tr>
                            <th rowspan="2">पूरा नाम (Full Name)</th>
                            <th rowspan="2">जन्म दर्ता नं. (Birth Registration No.)</th>
                            <th rowspan="2">जन्म मिति (Date of Birth)</th>
                            <th rowspan="2">लिङ्ग (Gender)</th>
                            <th colspan="3">नागरिकता विवरण (Citizen Details)</th>
                            <th rowspan="2">सूचकसँगको नाता (Relation with Informant)</th>
                            <th rowspan="2">Action</th>
                        </tr>
                        <tr>
                            <th>नागरिकता नं. (Citizenship No.)</th>
                            <th>जारी मिति (Issue Date)</th>
                            <th>जारी जिल्ला (Issue District)</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>
                                <input type="text" class="form-control" name="fullNameNepali[]" placeholder="पूरा नाम" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="birthRegNoNepali[]"
                                    placeholder="जन्म दर्ता नं." />
                            </td>
                            <td>
                                <input type="date" class="form-control" name="dobNepali[]" />
                            </td>
                            <td>
                                <select class="form-select" name="genderNepali[]">
                                    <option value="" selected disabled>छान्नुहोस्</option>
                                    <option value="male">पुरुष</option>
                                    <option value="female">महिला</option>
                                    <option value="other">अन्य</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="citizenNoNepali[]"
                                    placeholder="नागरिकता नं." />
                            </td>
                            <td>
                                <input type="date" class="form-control" name="issueDateNepali[]" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="issueDistrictNepali[]"
                                    placeholder="जारी जिल्ला" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="relationNepali[]" placeholder="नाता" />
                            </td>
                            <td rowspan="2">
                                <button type="button" class="btn btn-danger" onclick="deleteRow(this)">
                                    - हटाउनुहोस्
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="fullNameEnglish[]"
                                    placeholder="Full Name" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="birthRegNoEnglish[]"
                                    placeholder="Birth Reg. No." />
                            </td>
                            <td>
                                <input type="date" class="form-control" name="dobEnglish[]" />
                            </td>
                            <td>
                                <select class="form-select" name="genderEnglish[]">
                                    <option value="" selected disabled>Select</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="citizenNoEnglish[]"
                                    placeholder="Citizenship No." />
                            </td>
                            <td>
                                <input type="date" class="form-control" name="issueDateEnglish[]" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="issueDistrictEnglish[]"
                                    placeholder="Issue District" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="relationEnglish[]"
                                    placeholder="Relation" />
                            </td>

                        </tr>
                    </tbody>
                </table>
                <button type="button" class="btn btn-secondary" onclick="addRow()">
                    + थप्नुहोस्
                </button>
            </div>

            <!-- Section 4: Informant's Information -->
            <div class="mb-4">
                <h3>सूचकको विवरण</h3>
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
                                    <input type="text" class="form-control" id="currentDate" name="currentDate" placeholder="मिति"
                                        readonly />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Informant Confirmation -->
                <div class="form-check mt-3">
                    <input type="checkbox" class="form-check-input" id="informantConfirmation" required />
                    <label class="form-check-label" for="informantConfirmation">
                        यसमा दिएको विवरण साँचो हो। झुट्टा ठहरे कानुन बमोजिम सजाय भोग्न
                        तयार छु।
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                पेश गर्नुहोस् (Submit)
            </button>
        </form>
    </div>

    <script>
        document.getElementById("currentDate").value =
            new Date().toLocaleDateString("ne-NP");


        function showOtherReasonField() {
            const reasonSelect = document.getElementById("migrationReason");
            const otherReasonField = document.getElementById("otherReasonField");
            if (reasonSelect.value === "other") {
                otherReasonField.style.display = "block";
            } else {
                otherReasonField.style.display = "none";
            }
        }

        function addRow() {
            const table = document
                .getElementById("familyTable")
                .getElementsByTagName("tbody")[0];

            const nepaliRow = `
                <tr>
                    <td><input type="text" class="form-control" name="fullNameNepali[]" placeholder="पूरा नाम"></td>
                    <td><input type="text" class="form-control" name="birthRegNoNepali[]" placeholder="जन्म दर्ता नं."></td>
                    <td><input type="date" class="form-control" name="dobNepali[]"></td>
                    <td>
                        <select class="form-select" name="genderNepali[]">
                            <option value="" selected disabled>छान्नुहोस्</option>
                            <option value="male">पुरुष</option>
                            <option value="female">महिला</option>
                            <option value="other">अन्य</option>
                        </select>
                    </td>
                    <td><input type="text" class="form-control" name="citizenNoNepali[]" placeholder="नागरिकता नं."></td>
                    <td><input type="date" class="form-control" name="issueDateNepali[]"></td>
                    <td><input type="text" class="form-control" name="issueDistrictNepali[]" placeholder="जारी जिल्ला"></td>
                    <td><input type="text" class="form-control" name="relationNepali[]" placeholder="नाता"></td>
                    <td rowspan="2"><button type="button" class="btn btn-danger" onclick="deleteRow(this)">- हटाउनुहोस्</button></td>
                </tr>
            `;

            const englishRow = `
                <tr>
                    <td><input type="text" class="form-control" name="fullNameEnglish[]" placeholder="Full Name"></td>
                    <td><input type="text" class="form-control" name="birthRegNoEnglish[]" placeholder="Birth Reg. No."></td>
                    <td><input type="date" class="form-control" name="dobEnglish[]"></td>
                    <td>
                        <select class="form-select" name="genderEnglish[]">
                            <option value="" selected disabled>Select</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </td>
                    <td><input type="text" class="form-control" name="citizenNoEnglish[]" placeholder="Citizenship No."></td>
                    <td><input type="date" class="form-control" name="issueDateEnglish[]"></td>
                    <td><input type="text" class="form-control" name="issueDistrictEnglish[]" placeholder="Issue District"></td>
                    <td><input type="text" class="form-control" name="relationEnglish[]" placeholder="Relation"></td>
                    
                </tr>
            `;

            table.insertAdjacentHTML("beforeend", nepaliRow);
            table.insertAdjacentHTML("beforeend", englishRow);
        }

        function deleteRow(button) {
            const row = button.parentElement.parentElement;
            const table = row.parentElement;

            // Remove the Nepali-English row pair
            const index = Array.from(table.children).indexOf(row);
            if (index % 2 === 0) {
                table.children[index + 1]?.remove();
            } else {
                table.children[index - 1]?.remove();
            }
            row.remove();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>