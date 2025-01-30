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

$sql = "SELECT * FROM migration_records WHERE token = '$token'";
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
                    <thead>
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
                                <input type="text" class="form-control" name="currentProvince"
                                    value="<?php echo htmlspecialchars($row['current_province']); ?>" placeholder="प्रदेश" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="currentProvinceEn"
                                    value="<?php echo htmlspecialchars($row['current_province_en']); ?>" placeholder="Province" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="newProvince"
                                    value="<?php echo htmlspecialchars($row['new_province']); ?>" placeholder="प्रदेश" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="newProvinceEn"
                                    value="<?php echo htmlspecialchars($row['new_province_en']); ?>" placeholder="Province" />
                            </td>
                        </tr>
                        <tr>
                            <td>जिल्ला (District)</td>
                            <td>
                                <input type="text" class="form-control" name="currentDistrict"
                                    value="<?php echo htmlspecialchars($row['current_district']); ?>" placeholder="जिल्ला" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="currentDistrictEn"
                                    value="<?php echo htmlspecialchars($row['current_district_en']); ?>" placeholder="District" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="newDistrict"
                                    value="<?php echo htmlspecialchars($row['new_district']); ?>" placeholder="जिल्ला" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="newDistrictEn"
                                    value="<?php echo htmlspecialchars($row['new_district_en']); ?>" placeholder="District" />
                            </td>
                        </tr>
                        <tr>
                            <td>गा.वि.स./न.पा. (Municipality)</td>
                            <td>
                                <input type="text" class="form-control" name="currentMunicipality"
                                    value="<?php echo htmlspecialchars($row['current_municipality']); ?>" placeholder="गा.वि.स./न.पा." />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="currentMunicipalityEn"
                                    value="<?php echo htmlspecialchars($row['current_municipality_en']); ?>" placeholder="Municipality" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="newMunicipality"
                                    value="<?php echo htmlspecialchars($row['new_municipality']); ?>" placeholder="गा.वि.स./न.पा." />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="newMunicipalityEn"
                                    value="<?php echo htmlspecialchars($row['new_municipality_en']); ?>" placeholder="Municipality" />
                            </td>
                        </tr>
                        <tr>
                            <td>वडा नं. (Ward No.)</td>
                            <td>
                                <input type="number" class="form-control" name="currentWard"
                                    value="<?php echo htmlspecialchars($row['current_ward']); ?>" placeholder="वडा नं." />
                            </td>
                            <td>
                                <input type="number" class="form-control" name="currentWardEn"
                                    value="<?php echo htmlspecialchars($row['current_ward_en']); ?>" placeholder="Ward No." />
                            </td>
                            <td>
                                <input type="number" class="form-control" name="newWard"
                                    value="<?php echo htmlspecialchars($row['new_ward']); ?>" placeholder="वडा नं." />
                            </td>
                            <td>
                                <input type="number" class="form-control" name="newWardEn"
                                    value="<?php echo htmlspecialchars($row['new_ward_en']); ?>" placeholder="Ward No." />
                            </td>
                        </tr>
                        <tr>
                            <td>सडक/मार्ग (Street/Area)</td>
                            <td>
                                <input type="text" class="form-control" name="currentStreet"
                                    value="<?php echo htmlspecialchars($row['current_street']); ?>" placeholder="सडक/मार्ग" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="currentStreetEn"
                                    value="<?php echo htmlspecialchars($row['current_street_en']); ?>" placeholder="Street/Area" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="newStreet"
                                    value="<?php echo htmlspecialchars($row['new_street']); ?>" placeholder="सडक/मार्ग" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="newStreetEn"
                                    value="<?php echo htmlspecialchars($row['new_street_en']); ?>" placeholder="Street/Area" />
                            </td>
                        </tr>
                        <tr>
                            <td>गाउँ/टोल (Village/Tole)</td>
                            <td>
                                <input type="text" class="form-control" name="currentVillage"
                                    value="<?php echo htmlspecialchars($row['current_village']); ?>" placeholder="गाउँ/टोल" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="currentVillageEn"
                                    value="<?php echo htmlspecialchars($row['current_village_en']); ?>" placeholder="Village/Tole" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="newVillage"
                                    value="<?php echo htmlspecialchars($row['new_village']); ?>" placeholder="गाउँ/टोल" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="newVillageEn"
                                    value="<?php echo htmlspecialchars($row['new_village_en']); ?>" placeholder="Village/Tole" />
                            </td>
                        </tr>
                        <tr>
                            <td>घर नं. (House No.)</td>
                            <td>
                                <input type="text" class="form-control" name="currentHouse"
                                    value="<?php echo htmlspecialchars($row['current_house']); ?>" placeholder="घर नं." />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="currentHouseEn"
                                    value="<?php echo htmlspecialchars($row['current_house_en']); ?>" placeholder="House No." />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="newHouse"
                                    value="<?php echo htmlspecialchars($row['new_house']); ?>" placeholder="घर नं." />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="newHouseEn"
                                    value="<?php echo htmlspecialchars($row['new_house_en']); ?>" placeholder="House No." />
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
                        <input type="date" class="form-control" id="migrationDate" name="migrationDate"
                            value="<?php echo htmlspecialchars($row['migration_date']); ?>" />
                    </div>
                    <div class="col-md-6">
                        <label for="migrationReason" class="form-label">बसाई सराइ गरेको कारण (Reason for Migration)</label>
                        <select class="form-select" id="migrationReason" name="migrationReason" onchange="showOtherReasonField()" disabled>
                            <option value="" selected disabled>छान्नुहोस्</option>
                            <option value="job" <?php if ($row['migration_reason'] == 'job') echo 'selected'; ?>>नोकरी (Job)</option>
                            <option value="business" <?php if ($row['migration_reason'] == 'business') echo 'selected'; ?>>व्यापार/व्यवसाय (Business)</option>
                            <option value="housing" <?php if ($row['migration_reason'] == 'housing') echo 'selected'; ?>>घर फास (Housing)</option>
                            <option value="education" <?php if ($row['migration_reason'] == 'education') echo 'selected'; ?>>शिक्षा (Education)</option>
                            <option value="other" <?php if ($row['migration_reason'] == 'other') echo 'selected'; ?>>अन्य (Other)</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3" id="otherReasonField" style="display: <?php echo ($row['migration_reason'] == 'other' ? 'block' : 'none'); ?>;">
                    <div class="col-md-12">
                        <label for="otherReason" class="form-label">अन्य कारण उल्लेख गर्नुहोस् (Specify Other Reason)</label>
                        <input type="text" class="form-control" id="otherReason" name="otherReason"
                            value="<?php echo htmlspecialchars($row['other_reason']); ?>" placeholder="अन्य कारण" />
                    </div>
                </div>
            </div>

            <?php
            // Assuming $conn is already defined as the database connection
            $sql = "SELECT * FROM migration_records WHERE token = '$token'";
            $result = mysqli_query($conn, $sql);

            // Fetch migration record
            $row = mysqli_fetch_assoc($result);
            $id = $row['id']; // Extract the ID of the record

            // Fetch family members using the extracted id
            $family_sql = "SELECT * FROM family_members WHERE migration_id = ?";
            $stmt = mysqli_prepare($conn, $family_sql);
            mysqli_stmt_bind_param($stmt, "i", $id); // Binding the id parameter
            mysqli_stmt_execute($stmt);
            $family_result = mysqli_stmt_get_result($stmt);

            // Now you can fetch the family member data and populate the table
            ?>


            <!-- Section: Family Member Details -->
            <div class="mb-4">
                <h3>परिवारका सदस्यको विवरण (Family Member Details)</h3>
                <table class="table table-bordered" id="familyTable">
                    <thead>
                        <tr>
                            <th rowspan="2">पूरा नाम (Full Name)</th>
                            <th rowspan="2">जन्म दर्ता नं. (Birth Registration No.)</th>
                            <th rowspan="2">जन्म मिति (Date of Birth)</th>
                            <th rowspan="2">लिङ्ग (Gender)</th>
                            <th colspan="3">नागरिकता विवरण (Citizen Details)</th>
                            <th rowspan="2">सूचकसँगको नाता (Relation with Informant)</th>
                        </tr>
                        <tr>
                            <th>नागरिकता नं. (Citizenship No.)</th>
                            <th>जारी मिति (Issue Date)</th>
                            <th>जारी जिल्ला (Issue District)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Loop through each family member record and display it in the table
                        while ($family_row = mysqli_fetch_assoc($family_result)) {
                        ?>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="fullNameNepali[]" value="<?php echo htmlspecialchars($family_row['full_name_nepali']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="birthRegNoNepali[]" value="<?php echo htmlspecialchars($family_row['birth_reg_no_nepali']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="dobNepali[]" value="<?php echo htmlspecialchars($family_row['dob_nepali']); ?>" readonly />
                                </td>
                                <td>
                                    <select class="form-select" name="genderNepali[]" disabled>
                                        <option value="male" <?php echo ($family_row['gender_nepali'] == 'male') ? 'selected' : ''; ?>>पुरुष</option>
                                        <option value="female" <?php echo ($family_row['gender_nepali'] == 'female') ? 'selected' : ''; ?>>महिला</option>
                                        <option value="other" <?php echo ($family_row['gender_nepali'] == 'other') ? 'selected' : ''; ?>>अन्य</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="citizenNoNepali[]" value="<?php echo htmlspecialchars($family_row['citizen_no_nepali']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="issueDateNepali[]" value="<?php echo htmlspecialchars($family_row['issue_date_nepali']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="issueDistrictNepali[]" value="<?php echo htmlspecialchars($family_row['issue_district_nepali']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="relationNepali[]" value="<?php echo htmlspecialchars($family_row['relation_nepali']); ?>" readonly />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" name="fullNameEnglish[]" value="<?php echo htmlspecialchars($family_row['full_name_english']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="birthRegNoEnglish[]" value="<?php echo htmlspecialchars($family_row['birth_reg_no_english']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="dobEnglish[]" value="<?php echo htmlspecialchars($family_row['dob_english']); ?>" readonly />
                                </td>
                                <td>
                                    <select class="form-select" name="genderEnglish[]" disabled>
                                        <option value="male" <?php echo ($family_row['gender_english'] == 'male') ? 'selected' : ''; ?>>Male</option>
                                        <option value="female" <?php echo ($family_row['gender_english'] == 'female') ? 'selected' : ''; ?>>Female</option>
                                        <option value="other" <?php echo ($family_row['gender_english'] == 'other') ? 'selected' : ''; ?>>Other</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="citizenNoEnglish[]" value="<?php echo htmlspecialchars($family_row['citizen_no_english']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="date" class="form-control" name="issueDateEnglish[]" value="<?php echo htmlspecialchars($family_row['issue_date_english']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="issueDistrictEnglish[]" value="<?php echo htmlspecialchars($family_row['issue_district_english']); ?>" readonly />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="relationEnglish[]" value="<?php echo htmlspecialchars($family_row['relation_english']); ?>" readonly />
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
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
                                    <a href="download.php?token=<?php echo urlencode($token) ?>&file=informant_signature&table=migration_records" class="btn btn-secondary">Download</a>
                                </td>
                            </tr>
                            <tr>
                                <td>बायाँ औंठाको छाप</td>
                                <td>
                                    <a href="download.php?token=<?php echo urlencode($token) ?>&file=left_thumb_print&table=migration_records" class="btn btn-secondary">Download</a>
                                </td>
                            </tr>
                            <tr>
                                <td>दायाँ औंठाको छाप</td>
                                <td>
                                    <a href="download.php?token=<?php echo urlencode($token) ?>&file=right_thumb_print&table=migration_records" class="btn btn-secondary">Download</a>
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
        <a href="<?php echo $delete_disabled ? '#' : 'migration_delete.php?token=' . $token; ?>"
            class="btn btn-danger <?php echo $delete_disabled ? 'disabled' : ''; ?>"
            <?php echo $delete_disabled ? 'tabindex="-1" aria-disabled="true" style="pointer-events: none;"' : ''; ?>>
            Delete
        </a>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>