<?php

// path to data file
$data_path = "../data/input.txt";

// check if file exists and is readable
if (!file_exists($data_path) || !is_readable($data_path)) die("File not found or not readable!");

// read file and convert to array and convert to integer
$data = file($data_path, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
$data = array_map("intval", $data);

// bubble sort (we can use built-in function like sort() but I'm using bubble sort for this task)
// also we can use merge sort, but its not needed for small data
function bubbleSort($file, $sort) {
    if (empty($file)) return [];
    if (!is_array($file)) return [];
    if ($sort != "ASC" && $sort != "DESC") return [];

    for ($i = 0; $i < count($file); $i++) {
        for ($j = 0; $j < count($file) - 1; $j++) {

            // check if $sort is ASC or DESC
            if ($sort == "ASC") {
                if ($file[$j] > $file[$j + 1]) {
                    $temp = $file[$j];
                    $file[$j] = $file[$j + 1];
                    $file[$j + 1] = $temp;
                }
            }

            // check if $sort is ASC or DESC
            if ($sort == "DESC") {
                if ($file[$j] < $file[$j + 1]) {
                    $temp = $file[$j];
                    $file[$j] = $file[$j + 1];
                    $file[$j + 1] = $temp;
                }
            }

        }
    }

    return $file;
}

$number_list = bubbleSort($data, "ASC");
$highest_number = end($number_list);
?>


<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BITE INTERNSHIP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <section class="number-section d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="container" style="max-width: 600px;">

            <div class="title"><h1 class="text-center">Sorted list of numbers</h1></div>

            <div class="number-list mt-4">
                <ul class="list-group">
                    <?php foreach ($number_list as $number) { ?>
                        <li class="list-group-item"><?php echo $number; ?></li>
                    <?php } ?>
                </ul>
            </div>

            <div class="highest-number-form mt-5">
                <h2>Highest Number:</h2>
                <div class="alert alert-primary d-none" role="alert"></div>

                <div class="input-box d-flex gap-2">
                    <input type="number" class="form-control" id="highest-number" value="<?php echo $highest_number; ?>" readonly>
                    <div class="buttons d-flex gap-2">
                        <button class="btn btn-primary" id="plus5" onclick="change_value(true)">+5</button>
                        <button class="btn btn-primary" id="minus5" onclick="change_value(false)">-5</button>
                    </div>
                </div>

            </div>

        </div>
    </section>
    

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        const alert_err = document.querySelector('.alert');
        
        // increase highest value by 5 or down by 5
        const change_value = (increase) => {
            let input = document.getElementById('highest-number');
            let value = parseInt(input.value);

            if (!increase && value - 5 < 0) {
                alert_err.classList.remove('d-none');
                alert_err.innerHTML = `<strong>Error:</strong> The value <strong>${value}</strong> cannot go below <strong>0</strong>!`
            } else {
                alert_err.classList.add('d-none');
                input.value = increase ? value + 5 : value - 5;
            }
        }
    </script>
</body>
</html>