function getSlotsCount() {
  let slotcount1 = document.getElementById("slotcount1");
  let slotcount2 = document.getElementById("slotcount2");
  let slotcount3 = document.getElementById("slotcount3");
  let slotcount4 = document.getElementById("slotcount4");
  console.log('test');
  $.ajax({
    type: "POST",
    url: "assets/php/get-slot-count.php",
    dataType: "json",
    success: function (data) {
      if (data.status === 'success') {
        let counts = [0, 0, 0, 0];
        
        // Populate counts array with actual slot counts
        data.counts.forEach(function (slot) {
          if (slot.slot_id >= 1 && slot.slot_id <= 4) {
            counts[slot.slot_id - 1] = slot.total_records;
          }
        });

        // Set the innerHTML of the corresponding elements
        slotcount1.textContent = counts[0];
        slotcount2.textContent = counts[1];
        slotcount3.textContent = counts[2];
        slotcount4.textContent = counts[3];
      } else {
        console.error('Error:', data.message);
      }
    },
    error: function () {
      console.error("Error fetching data.");
    }
  });
}
