// Track the last known state and times for each parking slot
let lastKnownStates = {
  slot1: { state: null, inTime: null, outTime: null },
  slot2: { state: null, inTime: null, outTime: null },
  slot3: { state: null, inTime: null, outTime: null },
  slot4: { state: null, inTime: null, outTime: null },
};

function updateSlot(slotId, statusId, status, parkingSlot) {
  let slotElement = document.getElementById(slotId);
  let statusElement = document.getElementById(statusId);
  let inTimeElement = document.getElementById(`inTime${slotId.charAt(slotId.length - 1)}`);
  let outTimeElement = document.getElementById(`outTime${slotId.charAt(slotId.length - 1)}`);

  // Check the current state against the last known state
  if (status === 1) {
    // If the slot is now available
    if (lastKnownStates[slotId].state === 0) {
      // Log the out time only once when the slot becomes available
      lastKnownStates[slotId].outTime = new Date().toLocaleString();
      outTimeElement.innerHTML = lastKnownStates[slotId].outTime;  // Display TIME OUT
      console.log(`${parkingSlot} Time: Out at ${lastKnownStates[slotId].outTime}`);
    }

    slotElement.classList.remove("bg-danger");
    slotElement.classList.add("bg-success");
    statusElement.innerHTML = "<strong>" + parkingSlot + " Available</strong>";
    lastKnownStates[slotId].state = 1; // Update the last known state
  } else {
    // If the slot is now occupied
    if (lastKnownStates[slotId].state === 1) {
      // Log the in time only once when the slot becomes occupied
      lastKnownStates[slotId].inTime = new Date().toLocaleString();
      inTimeElement.innerHTML = lastKnownStates[slotId].inTime;  // Display TIME IN
      outTimeElement.innerHTML = null;
      console.log(`${parkingSlot} Time: In at ${lastKnownStates[slotId].inTime}`);
    }

    slotElement.classList.remove("bg-success");
    slotElement.classList.add("bg-danger");
    statusElement.innerHTML = "<strong>" + parkingSlot + " Occupied</strong>";
    lastKnownStates[slotId].state = 0; // Update the last known state
  }
}

function checkSensor() {
  $.ajax({
    type: "GET",
    url: "http://10.0.0.1/d1",
    success: function (data) {
      updateSlot('slot1', 'status1', data.sensorState, "P1 - ");
    },
    error: function (data) {
      console.error("Error fetching data for slot 1");
    },
  });

  $.ajax({
    type: "GET",
    url: "http://10.0.0.1/d2",
    success: function (data) {
      updateSlot("slot2", "status2", data.sensorState, "P2 - ");
    },
    error: function (data) {
      console.error("Error fetching data for slot 2");
    },
  });

  $.ajax({
    type: "GET",
    url: "http://10.0.0.1/d3",
    success: function (data) {
      updateSlot("slot3", "status3", data.sensorState, "P3 - ");
    },
    error: function (data) {
      console.error("Error fetching data for slot 3");
    },
  });

  $.ajax({
    type: "GET",
    url: "http://10.0.0.1/d4",
    success: function (data) {
      updateSlot("slot4", "status4", data.sensorState, "P4 - ");
    },
    error: function (data) {
      console.error("Error fetching data for slot 4");
    },
  });
}
