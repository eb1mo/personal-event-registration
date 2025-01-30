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

$sql = "SELECT * FROM death_records WHERE token = '$token'";
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
    <title>Death Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="rm-bs.css">
</head>

<body>
    <div class="container my-5">
        <a href="index.php" class="btn btn-primary mb-3">Back to Home ( फिर्ता जानुहोस् )</a>
        <h1 class="text-center mb-4">मृत्यु दर्ता फारम</h1>
        <form id="deathRegistrationForm" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <h4>मृतकको सूचना</h4>
                <label for="janmaDartaNumber" class="form-label">जन्म दर्ता नम्बर:</label>
                <input type="text" class="form-control" id="janmaDartaNumber" name="janmaDartaNumber" value="<?php echo htmlspecialchars($row['janma_darta_number']); ?>" readonly />
            </div>
            <div class="mb-3">
                <label for="nameNepali" class="form-label">नाम थर (नेपाली):</label>
                <input type="text" class="form-control" id="nameNepali" name="nameNepali" value="<?php echo htmlspecialchars($row['name_nepali']); ?>" readonly />
            </div>
            <div class="mb-3">
                <label for="nameEnglish" class="form-label">Full Name (In English):</label>
                <input type="text" class="form-control" id="nameEnglish" name="nameEnglish" value="<?php echo htmlspecialchars($row['name_english']); ?>" readonly />
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="dobNepali" class="form-label">जन्म मिति (नेपाली):</label>
                    <input type="date" class="form-control" id="dobNepali" name="dobNepali" value="<?php echo htmlspecialchars($row['dob_nepali']); ?>" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="dobEnglish" class="form-label">Date of Birth (AD):</label>
                    <input type="date" class="form-control" id="dobEnglish" name="dobEnglish" value="<?php echo htmlspecialchars($row['dob_english']); ?>" required />
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">जन्म भएको ठेगाना (नेपाली):</label>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>प्रदेश</label>
                        <input type="text" class="form-control" name="janmaPradesh" value="<?php echo htmlspecialchars($row['janma_pradesh']); ?>" placeholder="प्रदेश" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>जिल्ला</label>
                        <input type="text" class="form-control" name="janmaJilla" value="<?php echo htmlspecialchars($row['janma_jilla']); ?>" placeholder="जिल्ला" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>नगरपालिका/गाउँपालिका</label>
                        <input type="text" class="form-control" name="janmaNagarpalika" value="<?php echo htmlspecialchars($row['janma_nagarpalika']); ?>" placeholder="नगरपालिका/गाउँपालिका" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>वडा नम्बर</label>
                        <input type="number" class="form-control" name="janmaWard" value="<?php echo htmlspecialchars($row['janma_ward']); ?>" placeholder="वडा नम्बर" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>सडक/मार्ग</label>
                        <input type="text" class="form-control" name="janmaSadak" value="<?php echo htmlspecialchars($row['janma_sadak']); ?>" placeholder="सडक/मार्ग" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>घर नम्बर</label>
                        <input type="text" class="form-control" name="janmaGharNo" value="<?php echo htmlspecialchars($row['janma_ghar_no']); ?>" placeholder="घर नम्बर" required />
                    </div>
                    <div class="col-md-12 mb-2">
                        <label>गाउँ/टोल</label>
                        <input type="text" class="form-control" name="janmaGau" value="<?php echo htmlspecialchars($row['janma_gau']); ?>" placeholder="गाउँ/टोल" required />
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="mrituSthan" class="form-label">मृत्यु भएको स्थान:</label>
                <select class="form-select" id="mrituSthan" name="mrituSthan" disabled>
                    <option value="">छान्नुहोस्</option>
                    <option value="home" <?php echo ($row['mritu_sthan'] == 'home') ? 'selected' : ''; ?>>घर</option>
                    <option value="hospital" <?php echo ($row['mritu_sthan'] == 'hospital') ? 'selected' : ''; ?>>अस्पताल</option>
                    <option value="others" <?php echo ($row['mritu_sthan'] == 'others') ? 'selected' : ''; ?>>अन्य</option>
                </select>
            </div>


            <h4>२. मृतकको ठेगाना</h4>
            <div class="mb-3">
                <label class="form-label">ठेगाना (नेपाली):</label>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>प्रदेश</label>
                        <input type="text" class="form-control" name="mritakPradesh" value="<?php echo htmlspecialchars($row['mritak_pradesh']); ?>" placeholder="प्रदेश" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>जिल्ला</label>
                        <input type="text" class="form-control" name="mritakJilla" value="<?php echo htmlspecialchars($row['mritak_jilla']); ?>" placeholder="जिल्ला" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>नगरपालिका/गाउँपालिका</label>
                        <input type="text" class="form-control" name="mritakNagarpalika" value="<?php echo htmlspecialchars($row['mritak_nagarpalika']); ?>" placeholder="नगरपालिका/गाउँपालिका" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>वडा नम्बर</label>
                        <input type="number" class="form-control" name="mritakWard" value="<?php echo htmlspecialchars($row['mritak_ward']); ?>" placeholder="वडा नम्बर" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>सडक/मार्ग</label>
                        <input type="text" class="form-control" name="mritakSadak" value="<?php echo htmlspecialchars($row['mritak_sadak']); ?>" placeholder="सडक/मार्ग" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>घर नम्बर</label>
                        <input type="text" class="form-control" name="mritakGharNo" value="<?php echo htmlspecialchars($row['mritak_ghar_no']); ?>" placeholder="घर नम्बर" required />
                    </div>
                    <div class="col-md-12 mb-2">
                        <label>गाउँ/टोल</label>
                        <input type="text" class="form-control" name="mritakGau" value="<?php echo htmlspecialchars($row['mritak_gau']); ?>" placeholder="गाउँ/टोल" required />
                    </div>
                </div>
            </div>

            <h4>३. मृतकको ठेगाना (In English)</h4>
            <div class="mb-3">
                <label class="form-label">Address (In English):</label>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Province</label>
                        <input type="text" class="form-control" name="mritakPradeshEnglish" value="<?php echo htmlspecialchars($row['mritak_pradesh_english']); ?>" placeholder="Province" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>District</label>
                        <input type="text" class="form-control" name="mritakJillaEnglish" value="<?php echo htmlspecialchars($row['mritak_jilla_english']); ?>" placeholder="District" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Municipality/Rural Municipality</label>
                        <input type="text" class="form-control" name="mritakNagarpalikaEnglish" value="<?php echo htmlspecialchars($row['mritak_nagarpalika_english']); ?>" placeholder="Municipality/Rural Municipality" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Ward Number</label>
                        <input type="number" class="form-control" name="mritakWardEnglish" value="<?php echo htmlspecialchars($row['mritak_ward_english']); ?>" placeholder="Ward Number" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Street</label>
                        <input type="text" class="form-control" name="mritakSadakEnglish" value="<?php echo htmlspecialchars($row['mritak_sadak_english']); ?>" placeholder="Street" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>House Number</label>
                        <input type="text" class="form-control" name="mritakGharNoEnglish" value="<?php echo htmlspecialchars($row['mritak_ghar_no_english']); ?>" placeholder="House Number" required />
                    </div>
                    <div class="col-md-12 mb-2">
                        <label>Village/Town</label>
                        <input type="text" class="form-control" name="mritakGauEnglish" value="<?php echo htmlspecialchars($row['mritak_gau_english']); ?>" placeholder="Village/Town" required />
                    </div>
                </div>
            </div>


            <h4>४. मृतकको विवरण</h4>
            <div>
                <div class="mb-3">
                    <label for="nagariktaNumber" class="form-label">नागरिकता प्रमाणपत्र नम्बर:</label>
                    <input type="text" class="form-control" id="nagariktaNumber" name="nagariktaNumber" value="<?php echo htmlspecialchars($row['nagarikta_number']); ?>" required />
                </div>
                <div class="mb-3">
                    <label for="jariJilla" class="form-label">प्रमाणपत्र जारी जिल्ला:</label>
                    <input type="text" class="form-control" id="jariJilla" name="jariJilla" value="<?php echo htmlspecialchars($row['jari_jilla']); ?>" required />
                </div>
                <div class="mb-3">
                    <label for="jariMiti" class="form-label">प्रमाणपत्र जारी मिति (नेपाली):</label>
                    <input type="date" class="form-control" id="jariMiti" name="jariMiti" value="<?php echo htmlspecialchars($row['jari_miti']); ?>" required />
                </div>
                <div class="mb-3">
                    <label for="baibahikSthiti" class="form-label">पूर्व वैवाहिक स्थिति:</label>
                    <select class="form-select" id="baibahikSthiti" name="baibahikSthiti" disabled>
                        <option value="">छान्नुहोस्</option>
                        <option value="bibahit" <?php echo ($row['baibahik_sthiti'] == 'bibahit') ? 'selected' : ''; ?>>बिबाहित</option>
                        <option value="abibahit" <?php echo ($row['baibahik_sthiti'] == 'abibahit') ? 'selected' : ''; ?>>अबिबाहित</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="shikshya" class="form-label">उतीर्ण तह (शिक्षा):</label>
                    <input type="text" class="form-control" id="shikshya" name="shikshya" value="<?php echo htmlspecialchars($row['shikshya']); ?>" required />
                </div>
                <div class="mb-3">
                    <label for="matribhasa" class="form-label">मातृभाषा:</label>
                    <input type="text" class="form-control" id="matribhasa" name="matribhasa" value="<?php echo htmlspecialchars($row['matribhasa']); ?>" required />
                </div>
                <div class="mb-3">
                    <label for="dharma" class="form-label">धर्म:</label>
                    <input type="text" class="form-control" id="dharma" name="dharma" value="<?php echo htmlspecialchars($row['dharma']); ?>" required />
                </div>
                <div class="mb-3">
                    <label for="jatJati" class="form-label">जात/जाती:</label>
                    <input type="text" class="form-control" id="jatJati" name="jatJati" value="<?php echo htmlspecialchars($row['jat_jati']); ?>" required />
                </div>
                <div class="mb-3">
                    <label for="bajeKoPuraName" class="form-label">बाजेको पूरा नाम:</label>
                    <input type="text" class="form-control" id="bajeKoPuraName" name="bajeKoPuraName" value="<?php echo htmlspecialchars($row['baje_ko_pura_name']); ?>" required />
                </div>
                <div class="mb-3">
                    <label for="bajeKoPuraNameEng" class="form-label">Grandfather's Full Name (In English):</label>
                    <input type="text" class="form-control" id="bajeKoPuraNameEng" name="bajeKoPuraNameEng" value="<?php echo htmlspecialchars($row['baje_ko_pura_name_eng']); ?>" required />
                </div>
                <div class="mb-3">
                    <label for="bubaKoPuraName" class="form-label">बाबुको पूरा नाम:</label>
                    <input type="text" class="form-control" id="bubaKoPuraName" name="bubaKoPuraName" value="<?php echo htmlspecialchars($row['buba_ko_pura_name']); ?>" required />
                </div>
                <div class="mb-3">
                    <label for="bubaKoPuraNameEng" class="form-label">Father's Full Name (In English):</label>
                    <input type="text" class="form-control" id="bubaKoPuraNameEng" name="bubaKoPuraNameEng" value="<?php echo htmlspecialchars($row['buba_ko_pura_name_eng']); ?>" required />
                </div>
                <div class="mb-3">
                    <label for="aamaKoName" class="form-label">आमाको नाम:</label>
                    <input type="text" class="form-control" id="aamaKoName" name="aamaKoName" value="<?php echo htmlspecialchars($row['aama_ko_name']); ?>" required />
                </div>
                <div class="mb-3">
                    <label for="aamaKoNameEng" class="form-label">Mother's Name (In English):</label>
                    <input type="text" class="form-control" id="aamaKoNameEng" name="aamaKoNameEng" value="<?php echo htmlspecialchars($row['aama_ko_name_eng']); ?>" required />
                </div>
            </div>

            <h4>५. मृतक विवाहित भएमा</h4>
            <div class="mb-3">
                <label for="patiPatniName" class="form-label">पति/पत्नीको नाम:</label>
                <input type="text" class="form-control" id="patiPatniName" name="patiPatniName"
                    value="<?php echo htmlspecialchars($row['pati_patni_name'] ?? ''); ?>" required />
            </div>
            <div class="mb-3">
                <label for="patiPatniNameEng" class="form-label">Spouse's Name (In English):</label>
                <input type="text" class="form-control" id="patiPatniNameEng" name="patiPatniNameEng"
                    value="<?php echo htmlspecialchars($row['pati_patni_name_eng'] ?? ''); ?>" required />
            </div>



            <?php

            $token2 = mysqli_real_escape_string($conn, $_GET['token']);

            $sql2 = "SELECT * FROM death_records WHERE token = '$token2'";
            $result2 = mysqli_query($conn, $sql2);

            // Fetch the death record details from the existing result variable
            if ($result2 && mysqli_num_rows($result2) > 0) {
                $death_record = mysqli_fetch_assoc($result2); // Get the first row
                $death_record_id = $death_record['id']; // Extract the id
            } else {
                die("Invalid token or no record found.");
            }

            // Fetch spouses data using death_record_id
            $spouse_query = "SELECT spouse_name_nepali, spouse_name_english FROM spouses WHERE death_record_id = '$death_record_id'";
            $spouse_result = mysqli_query($conn, $spouse_query);

            $spouses = [];
            while ($row2 = mysqli_fetch_assoc($spouse_result)) {
                $spouses[] = $row2;
            }
            ?>

            <!-- Display Spouses in a Table -->
            <?php if (!empty($spouses)): ?>
                <div class="mb-3">
                    <label class="form-label">दुई वा सोभन्दा बढी पत्नी भएमा:</label>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>Name (English)</td>
                                <td>नाम (नेपाली)</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($spouses as $spouse): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($spouse['spouse_name_english']); ?></td>
                                    <td><?php echo htmlspecialchars($spouse['spouse_name_nepali']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p>पति/पत्नीको विवरण उपलब्ध छैन।</p>
            <?php endif; ?>

            <div class="mb-3">
                <label for="mrituKaran" class="form-label">मृत्युको कारण:</label>
                <input type="text" class="form-control" id="mrituKaran" name="mrituKaran" value="<?php echo htmlspecialchars($row['mritu_karan']); ?>" required />
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
                                        value="<?php echo htmlspecialchars($row['informant_name_english']); ?>" required />
                                </td>
                            </tr>

                            <!-- Relationship -->
                            <tr>
                                <td>मृतकसँगको नाता</td>
                                <td>
                                    <input type="text" class="form-control" name="relationshipTo"
                                        value="<?php echo htmlspecialchars($row['relationship_to']); ?>" required />
                                </td>
                            </tr>

                            <!-- Address Breakdown -->
                            <tr>
                                <td>जिल्ला</td>
                                <td>
                                    <input type="text" class="form-control" name="informantDistrict"
                                        value="<?php echo htmlspecialchars($row['informant_district']); ?>" required />
                                </td>
                            </tr>
                            <tr>
                                <td>गा.वि.स./न.पा.</td>
                                <td>
                                    <input type="text" class="form-control" name="informantMunicipality"
                                        value="<?php echo htmlspecialchars($row['informant_municipality']); ?>" required />
                                </td>
                            </tr>
                            <tr>
                                <td>वडा नम्बर</td>
                                <td>
                                    <input type="number" class="form-control" name="informantWard"
                                        value="<?php echo htmlspecialchars($row['informant_ward']); ?>" required />
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
                                        value="<?php echo htmlspecialchars($row['informant_citizenship_no']); ?>" required />
                                </td>
                            </tr>
                            <tr>
                                <td>प्रमाणपत्र जारी मिति</td>
                                <td>
                                    <input type="date" class="form-control" name="informantCitizenshipDate"
                                        value="<?php echo htmlspecialchars($row['informant_citizenship_date']); ?>" required />
                                </td>
                            </tr>
                            <tr>
                                <td>प्रमाणपत्र जारी जिल्ला</td>
                                <td>
                                    <input type="text" class="form-control" name="informantCitizenshipDistrict"
                                        value="<?php echo htmlspecialchars($row['informant_citizenship_district']); ?>" required />
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
                                    <a href="download.php?token=<?php echo urlencode($token) ?>&file=informant_signature&table=death_records" class="btn btn-secondary">Download</a>
                                </td>
                            </tr>
                            <tr>
                                <td>बायाँ औंठाको छाप</td>
                                <td>
                                    <a href="download.php?token=<?php echo urlencode($token) ?>&file=left_thumb_print&table=death_records" class="btn btn-secondary">Download</a>
                                </td>
                            </tr>
                            <tr>
                                <td>दायाँ औंठाको छाप</td>
                                <td>
                                    <a href="download.php?token=<?php echo urlencode($token) ?>&file=right_thumb_print&table=death_records" class="btn btn-secondary">Download</a>
                                </td>
                            </tr>

                            <!-- Current Date -->
                            <tr>
                                <td>मिति</td>
                                <td>
                                    <input type="text" class="form-control" name="currentDate" id="currentDate"
                                        value="<?php echo date('Y-m-d'); ?>" readonly />
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
        <a href="<?php echo $delete_disabled ? '#' : 'death_delete.php?token=' . $token; ?>"
            class="btn btn-danger <?php echo $delete_disabled ? 'disabled' : ''; ?>"
            <?php echo $delete_disabled ? 'tabindex="-1" aria-disabled="true" style="pointer-events: none;"' : ''; ?>>
            Delete
        </a>
    </div>
</body>



</html>