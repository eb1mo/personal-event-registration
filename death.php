<?php
// Include database connection
include 'database.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Main record fields
    $janmaDartaNumber = $_POST['janmaDartaNumber'];
    $nameNepali = $_POST['nameNepali'];
    $nameEnglish = $_POST['nameEnglish'];
    $dobNepali = $_POST['dobNepali'];
    $dobEnglish = $_POST['dobEnglish'];

    $janmaPradesh = $_POST['janmaPradesh'];
    $janmaJilla = $_POST['janmaJilla'];
    $janmaNagarpalika = $_POST['janmaNagarpalika'];
    $janmaWard = $_POST['janmaWard'];
    $janmaSadak = $_POST['janmaSadak'];
    $janmaGharNo = $_POST['janmaGharNo'];
    $janmaGau = $_POST['janmaGau'];

    $mrituSthan = $_POST['mrituSthan'];

    $mritakPradesh = $_POST['mritakPradesh'];
    $mritakJilla = $_POST['mritakJilla'];
    $mritakNagarpalika = $_POST['mritakNagarpalika'];
    $mritakWard = $_POST['mritakWard'];
    $mritakSadak = $_POST['mritakSadak'];
    $mritakGharNo = $_POST['mritakGharNo'];
    $mritakGau = $_POST['mritakGau'];

    $mritakPradeshEnglish = $_POST['mritakPradeshEnglish'];
    $mritakJillaEnglish = $_POST['mritakJillaEnglish'];
    $mritakNagarpalikaEnglish = $_POST['mritakNagarpalikaEnglish'];
    $mritakWardEnglish = $_POST['mritakWardEnglish'];
    $mritakSadakEnglish = $_POST['mritakSadakEnglish'];
    $mritakGharNoEnglish = $_POST['mritakGharNoEnglish'];
    $mritakGauEnglish = $_POST['mritakGauEnglish'];

    $nagariktaNumber = $_POST['nagariktaNumber'];
    $jariJilla = $_POST['jariJilla'];
    $jariMiti = $_POST['jariMiti'];
    $baibahikSthiti = $_POST['baibahikSthiti'];
    $shikshya = $_POST['shikshya'];
    $matribhasa = $_POST['matribhasa'];
    $dharma = $_POST['dharma'];
    $jatJati = $_POST['jatJati'];

    $bajeKoPuraName = $_POST['bajeKoPuraName'];
    $bajeKoPuraNameEng = $_POST['bajeKoPuraNameEng'];
    $bubaKoPuraName = $_POST['bubaKoPuraName'];
    $bubaKoPuraNameEng = $_POST['bubaKoPuraNameEng'];
    $aamaKoName = $_POST['aamaKoName'];
    $aamaKoNameEng = $_POST['aamaKoNameEng'];
    $patiPatniName = $_POST['patiPatniName'];
    $patiPatniNameEng = $_POST['patiPatniNameEng'];

    $mrituKaran = $_POST['mrituKaran'];

    $informantNameNepali = $_POST['informantNameNepali'];
    $informantNameEnglish = $_POST['informantNameEnglish'];
    $relationshipTo = $_POST['relationshipTo'];
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
        $token = 'D' . strtoupper(substr(md5(uniqid()), 0, 5));

        // Insert main record into death_records
        $query = "INSERT INTO death_records (
            token, janma_darta_number, name_nepali, name_english, dob_nepali, dob_english, janma_pradesh, janma_jilla, 
            janma_nagarpalika, janma_ward, janma_sadak, janma_ghar_no, janma_gau, mritu_sthan, mritak_pradesh, 
            mritak_jilla, mritak_nagarpalika, mritak_ward, mritak_sadak, mritak_ghar_no, mritak_gau, mritak_pradesh_english, 
            mritak_jilla_english, mritak_nagarpalika_english, mritak_ward_english, mritak_sadak_english, 
            mritak_ghar_no_english, mritak_gau_english, nagarikta_number, jari_jilla, jari_miti, baibahik_sthiti, 
            shikshya, matribhasa, dharma, jat_jati, baje_ko_pura_name, baje_ko_pura_name_eng, buba_ko_pura_name, 
            buba_ko_pura_name_eng, aama_ko_name, aama_ko_name_eng, pati_patni_name, pati_patni_name_eng, mritu_karan, 
            informant_name_nepali, informant_name_english, relationship_to, informant_district, 
            informant_municipality, informant_ward, informant_street, informant_house_no, informant_citizenship_no, 
            informant_citizenship_date, informant_citizenship_district, informant_passport_no, informant_passport_country, 
            informant_signature, left_thumb_print, right_thumb_print
        ) VALUES (
            '$token', '$janmaDartaNumber', '$nameNepali', '$nameEnglish', '$dobNepali', '$dobEnglish', '$janmaPradesh', 
            '$janmaJilla', '$janmaNagarpalika', '$janmaWard', '$janmaSadak', '$janmaGharNo', '$janmaGau', '$mrituSthan', 
            '$mritakPradesh', '$mritakJilla', '$mritakNagarpalika', '$mritakWard', '$mritakSadak', '$mritakGharNo', 
            '$mritakGau', '$mritakPradeshEnglish', '$mritakJillaEnglish', '$mritakNagarpalikaEnglish', '$mritakWardEnglish', 
            '$mritakSadakEnglish', '$mritakGharNoEnglish', '$mritakGauEnglish', '$nagariktaNumber', '$jariJilla', 
            '$jariMiti', '$baibahikSthiti', '$shikshya', '$matribhasa', '$dharma', '$jatJati', '$bajeKoPuraName', 
            '$bajeKoPuraNameEng', '$bubaKoPuraName', '$bubaKoPuraNameEng', '$aamaKoName', '$aamaKoNameEng', 
            '$patiPatniName', '$patiPatniNameEng', '$mrituKaran', '$informantNameNepali', '$informantNameEnglish', 
            '$relationshipTo', '$informantDistrict', '$informantMunicipality', '$informantWard', '$informantStreet', 
            '$informantHouseNo', '$informantCitizenshipNo', '$informantCitizenshipDate', '$informantCitizenshipDistrict', 
            '$informantPassportNo', '$informantPassportCountry', '$informantSignature', '$leftThumbPrint', '$rightThumbPrint'
        )";

        if (mysqli_query($conn, $query)) {
            $deathRecordId = mysqli_insert_id($conn); // Get the ID of the inserted main record

            // Handle spouse records
            $spouseNamesNepali = $_POST['spouseNameNepali'];
            $spouseNamesEnglish = $_POST['spouseNameEnglish'];

            if (!empty($spouseNamesNepali)) {
                $spouseQuery = "INSERT INTO spouses (death_record_id, spouse_name_nepali, spouse_name_english) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($spouseQuery);
                foreach ($spouseNamesNepali as $index => $spouseNameNepali) {
                    $spouseNameEnglish = $spouseNamesEnglish[$index];
                    $stmt->bind_param("iss", $deathRecordId, $spouseNameNepali, $spouseNameEnglish);
                    $stmt->execute();
                }
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
    <title>Death Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="rm-bs.css">
</head>

<body>
    <div class="container mt-5">
        <a href="index.php" class="btn btn-primary mb-3">Back to Home ( फिर्ता जानुहोस् )</a>
        <h1 class="text-center mb-4">मृत्यु दर्ता फारम</h1>
        <form id="deathRegistrationForm" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <h4>मृतकको सूचना</h4>
                <label for="janmaDartaNumber" class="form-label">जन्म दर्ता नम्बर:</label>
                <input type="text" class="form-control" id="janmaDartaNumber" name="janmaDartaNumber" required />
            </div>
            <div class="mb-3">
                <label for="nameNepali" class="form-label">नाम थर (नेपाली):</label>
                <input type="text" class="form-control" id="nameNepali" name="nameNepali" required />
            </div>
            <div class="mb-3">
                <label for="nameEnglish" class="form-label">Full Name (In English):</label>
                <input type="text" class="form-control" id="nameEnglish" name="nameEnglish" required />
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="dobNepali" class="form-label">जन्म मिति (नेपाली):</label>
                    <input type="date" class="form-control" id="dobNepali" name="dobNepali" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="dobEnglish" class="form-label">Date of Birth (AD):</label>
                    <input type="date" class="form-control" id="dobEnglish" name="dobEnglish" required />
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">जन्म भएको ठेगाना (नेपाली):</label>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>प्रदेश</label>
                        <input type="text" class="form-control" name="janmaPradesh" placeholder="प्रदेश" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>जिल्ला</label>
                        <input type="text" class="form-control" name="janmaJilla" placeholder="जिल्ला" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>नगरपालिका/गाउँपालिका</label>
                        <input type="text" class="form-control" name="janmaNagarpalika" placeholder="नगरपालिका/गाउँपालिका" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>वडा नम्बर</label>
                        <input type="number" class="form-control" name="janmaWard" placeholder="वडा नम्बर" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>सडक/मार्ग</label>
                        <input type="text" class="form-control" name="janmaSadak" placeholder="सडक/मार्ग" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>घर नम्बर</label>
                        <input type="text" class="form-control" name="janmaGharNo" placeholder="घर नम्बर" required />
                    </div>
                    <div class="col-md-12 mb-2">
                        <label>गाउँ/टोल</label>
                        <input type="text" class="form-control" name="janmaGau" placeholder="गाउँ/टोल" required />
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="mrituSthan" class="form-label">मृत्यु भएको स्थान:</label>
                <select class="form-select" id="mrituSthan" name="mrituSthan" required>
                    <option value="">छान्नुहोस्</option>
                    <option value="home">घर</option>
                    <option value="hospital">अस्पताल</option>
                    <option value="others">अन्य</option>
                </select>
            </div>

            <h4>२. मृतकको ठेगाना</h4>
            <div class="mb-3">
                <label class="form-label">ठेगाना (नेपाली):</label>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>प्रदेश</label>
                        <input type="text" class="form-control" name="mritakPradesh" placeholder="प्रदेश" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>जिल्ला</label>
                        <input type="text" class="form-control" name="mritakJilla" placeholder="जिल्ला" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>नगरपालिका/गाउँपालिका</label>
                        <input type="text" class="form-control" name="mritakNagarpalika" placeholder="नगरपालिका/गाउँपालिका"
                            required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>वडा नम्बर</label>
                        <input type="number" class="form-control" name="mritakWard" placeholder="वडा नम्बर" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>सडक/मार्ग</label>
                        <input type="text" class="form-control" name="mritakSadak" placeholder="सडक/मार्ग" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>घर नम्बर</label>
                        <input type="text" class="form-control" name="mritakGharNo" placeholder="घर नम्बर" required />
                    </div>
                    <div class="col-md-12 mb-2">
                        <label>गाउँ/टोल</label>
                        <input type="text" class="form-control" name="mritakGau" placeholder="गाउँ/टोल" required />
                    </div>
                </div>
            </div>

            <h4>३. मृतकको ठेगाना (In English)</h4>
            <div class="mb-3">
                <label class="form-label">Address (In English):</label>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Province</label>
                        <input type="text" class="form-control" name="mritakPradeshEnglish" placeholder="Province" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>District</label>
                        <input type="text" class="form-control" name="mritakJillaEnglish" placeholder="District" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Municipality/Rural Municipality</label>
                        <input type="text" class="form-control" name="mritakNagarpalikaEnglish"
                            placeholder="Municipality/Rural Municipality" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Ward Number</label>
                        <input type="number" class="form-control" name="mritakWardEnglish" placeholder="Ward Number" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Street</label>
                        <input type="text" class="form-control" name="mritakSadakEnglish" placeholder="Street" required />
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>House Number</label>
                        <input type="text" class="form-control" name="mritakGharNoEnglish" placeholder="House Number" required />
                    </div>
                    <div class="col-md-12 mb-2">
                        <label>Village/Town</label>
                        <input type="text" class="form-control" name="mritakGauEnglish" placeholder="Village/Town" required />
                    </div>
                </div>
            </div>

            <h4>४. मृतकको विवरण</h4>
            <div class="mb-3">
                <label for="nagariktaNumber" class="form-label">नागरिकता प्रमाणपत्र नम्बर:</label>
                <input type="text" class="form-control" id="nagariktaNumber" name="nagariktaNumber" required />
            </div>
            <div class="mb-3">
                <label for="jariJilla" class="form-label">प्रमाणपत्र जारी जिल्ला:</label>
                <input type="text" class="form-control" id="jariJilla" name="jariJilla" required />
            </div>
            <div class="mb-3">
                <label for="jariMiti" class="form-label">प्रमाणपत्र जारी मिति (नेपाली):</label>
                <input type="date" class="form-control" id="jariMiti" name="jariMiti" required />
            </div>
            <div class="mb-3">
                <label for="baibahikSthiti" class="form-label">पूर्व वैवाहिक स्थिति:</label>
                <select class="form-select" id="baibahikSthiti" name="baibahikSthiti" onchange="toggleSpouseFields()">
                    <option value="">छान्नुहोस्</option>
                    <option value="bibahit">बिबाहित</option>
                    <option value="abibahit">अबिबाहित</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="shikshya" class="form-label">उतीर्ण तह (शिक्षा):</label>
                <input type="text" class="form-control" id="shikshya" name="shikshya" required />
            </div>
            <div class="mb-3">
                <label for="matribhasa" class="form-label">मातृभाषा:</label>
                <input type="text" class="form-control" id="matribhasa" name="matribhasa" required />
            </div>
            <div class="mb-3">
                <label for="dharma" class="form-label">धर्म:</label>
                <input type="text" class="form-control" id="dharma" name="dharma" required />
            </div>
            <div class="mb-3">
                <label for="jatJati" class="form-label">जात/जाती:</label>
                <input type="text" class="form-control" id="jatJati" name="jatJati" required />
            </div>
            <div class="mb-3">
                <label for="bajeKoPuraName" class="form-label">बाजेको पूरा नाम:</label>
                <input type="text" class="form-control" id="bajeKoPuraName" name="bajeKoPuraName" required />
            </div>
            <div class="mb-3">
                <label for="bajeKoPuraNameEng" class="form-label">Grandfather's Full Name (In English):</label>
                <input type="text" class="form-control" id="bajeKoPuraNameEng" name="bajeKoPuraNameEng" required />
            </div>
            <div class="mb-3">
                <label for="bubaKoPuraName" class="form-label">बाबुको पूरा नाम:</label>
                <input type="text" class="form-control" id="bubaKoPuraName" name="bubaKoPuraName" required />
            </div>
            <div class="mb-3">
                <label for="bubaKoPuraNameEng" class="form-label">Father's Full Name (In English):</label>
                <input type="text" class="form-control" id="bubaKoPuraNameEng" name="bubaKoPuraNameEng" required />
            </div>
            <div class="mb-3">
                <label for="aamaKoName" class="form-label">आमाको नाम:</label>
                <input type="text" class="form-control" id="aamaKoName" name="aamaKoName" required />
            </div>
            <div class="mb-3">
                <label for="aamaKoNameEng" class="form-label">Mother's Name (In English):</label>
                <input type="text" class="form-control" id="aamaKoNameEng" name="aamaKoNameEng" required />
            </div>

            <div id="ifBibahit">
                <h4>५. मृतक विवाहित भएमा</h4>
                <div class="mb-3">
                    <label for="patiPatniName" class="form-label">पति/पत्नीको नाम:</label>
                    <input type="text" class="form-control" id="patiPatniName" name="patiPatniName" required />
                </div>
                <div class="mb-3">
                    <label for="patiPatniNameEng" class="form-label">Spouse's Name (In English):</label>
                    <input type="text" class="form-control" id="patiPatniNameEng" name="patiPatniNameEng" required />
                </div>
                <div class="mb-3">
                    <label for="additionalSpouses" class="form-label">दुई वा सोभन्दा बढी पत्नी भएमा सबैको नाम उल्लिखित
                        गर्नुहोस्:</label>
                    <div id="spouseList">
                        <div class="input-group mb-2 spouse-field">
                            <input type="text" class="form-control" name="spouseNameNepali[]" placeholder="नाम (नेपाली)" />
                            <input type="text" class="form-control" name="spouseNameEnglish[]" placeholder="Name (English)" />
                            <button type="button" class="btn btn-danger" onclick="removeSpouseField(this)">
                                - हटाउनुहोस्
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="addSpouseField()">
                        + थप्नुहोस्
                    </button>
                </div>
            </div>
            <div class="mb-3">
                <label for="mrituKaran" class="form-label">मृत्युको कारण:</label>
                <input type="text" class="form-control" id="mrituKaran" name="mrituKaran" required />
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
                                    <input type="text" class="form-control" name="informantNameNepali" placeholder="सूचकको नाम (नेपालीमा)"
                                        required />
                                </td>
                            </tr>
                            <tr>
                                <td>Full Name (In English)</td>
                                <td>
                                    <input type="text" class="form-control" name="informantNameEnglish" placeholder="Informant's Full Name"
                                        required />
                                </td>
                            </tr>

                            <!-- Relationship -->
                            <tr>
                                <td>मृतकसँगको नाता</td>
                                <td>
                                    <input type="text" class="form-control" name="relationshipTo"
                                        placeholder="सूचकको नाता (उदाहरण: बुबा, आमा)" required />
                                </td>
                            </tr>

                            <!-- Address Breakdown -->
                            <tr>
                                <td>जिल्ला</td>
                                <td>
                                    <input type="text" class="form-control" name="informantDistrict" placeholder="जिल्ला" required />
                                </td>
                            </tr>
                            <tr>
                                <td>गा.वि.स./न.पा.</td>
                                <td>
                                    <input type="text" class="form-control" name="informantMunicipality" placeholder="गा.वि.स./न.पा."
                                        required />
                                </td>
                            </tr>
                            <tr>
                                <td>वडा नम्बर</td>
                                <td>
                                    <input type="number" class="form-control" name="informantWard" placeholder="वडा नम्बर" required />
                                </td>
                            </tr>
                            <tr>
                                <td>सडक/टोल</td>
                                <td>
                                    <input type="text" class="form-control" name="informantStreet" placeholder="सडक/टोल" />
                                </td>
                            </tr>
                            <tr>
                                <td>घर नम्बर</td>
                                <td>
                                    <input type="text" class="form-control" name="informantHouseNo" placeholder="घर नम्बर" />
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
                                    <input type="text" class="form-control" name="informantPassportNo" placeholder="पासपोर्ट नम्बर" />
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
                                    <input type="file" class="form-control" name="informantSignature" accept=".jpg, .png, .pdf" required />
                                </td>
                            </tr>
                            <tr>
                                <td>बायाँ औंठाको छाप</td>
                                <td>
                                    <input type="file" class="form-control" name="leftThumbPrint" accept=".jpg, .png, .pdf" required />
                                </td>
                            </tr>
                            <tr>
                                <td>दायाँ औंठाको छाप</td>
                                <td>
                                    <input type="file" class="form-control" name="rightThumbPrint" accept=".jpg, .png, .pdf" required />
                                </td>
                            </tr>

                            <!-- Current Date -->
                            <tr>
                                <td>मिति</td>
                                <td>
                                    <input type="text" class="form-control" name="currentDate" id="currentDate" placeholder="मिति" readonly />
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
            <button type="submit" class="btn btn-primary">पेश गर्नुहोस् (Submit)</button>
        </form>
    </div>
</body>

<script>
    document.getElementById("currentDate").value =
        new Date().toLocaleDateString("ne-NP");

    function addSpouseField() {
        let spouseList = document.getElementById("spouseList");
        let newField = document.createElement("div");
        newField.classList.add("input-group", "mb-2", "spouse-field");
        newField.innerHTML = `
        <input type="text" class="form-control" name="spouseNameNepali[]" placeholder="नाम (नेपाली)">
        <input type="text" class="form-control" name="spouseNameEnglish[]" placeholder="Name (English)">
        <button type="button" class="btn btn-danger" onclick="removeSpouseField(this)">- हटाउनुहोस्</button>
    `;
        spouseList.appendChild(newField);
    }

    function removeSpouseField(button) {
        button.parentElement.remove();
    }

    function toggleSpouseFields() {
        let baibahikSthiti = document.getElementById("baibahikSthiti").value;
        let ifBibahit = document.getElementById("ifBibahit");

        if (baibahikSthiti === "bibahit") {
            ifBibahit.style.display = "block";
        } else {
            ifBibahit.style.display = "none";
        }
    }
</script>

</html>