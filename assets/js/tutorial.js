const driver = window.driver.js.driver;

const ClientObj = driver({
  showProgress: true,
  allowClose: false,
  steps: [
    {
      element: "#card-vehicle-in",
      popover: {
        title: "Vehicle In",
        description:
          "Diri nimo makita kung pila ka sakyanan ang nisulod sa parkingan.",
        side: "bottom",
        align: "start",
      },
    },
    {
      element: "#card-vehicle-out",
      popover: {
        title: "Vehicle Out",
        description:
          "Diri nimo makita kung pila ka sakyanan ang nigawas sa parkingan.",
        side: "bottom",
        align: "start",
      },
    },
    {
      element: "#card-vehicle-currently-parked",
      popover: {
        title: "Vehicle Currently Parked",
        description:
          "diri nimo makita kung pila ka sakyanan ang naka parking sa parkingan.",
        side: "bottom",
        align: "start",
      },
    },
    {
      element: "#parking-slots",
      popover: {
        title: "Parking Area",
        description:
          "Diri nimo makita tanang parkinganan, diri sad nimo makita kung ang parkingan naa bay sakyanan or wala. ang color niini nga walay sakyanan kay green, ang color pud niini nga adonay sakyanan kay color red, kini siya maoy tima-ilhan nga pwedi ba kini parkingan or dili kay naay sakyanan nga nag parking, ug diri sad nimo makita ang oras nga naka parking ang sakyanan sa parkinganan.",
        side: "bottom",
        align: "start",
      },
    },
    {
      element: "#parking-lot-image",
      popover: {
        title: "Parking Area Map",
        description:
          "Kani nga mapa, maonay mo giya kanimo kung asa ka dapit mo agi padulong sa parkinganan",
        side: "bottom",
        align: "start",
      },
    },
    {
      popover: {
        title:
          "Maayong Adlaw ug Daghang Salamat sa pag bisita sa Gaisano Capital Pagadian City",
        description: "Ang Diyos Maga-uban kanato kanunay!",
      },
    },
  ],
});

const AdminObj = driver({
  showProgress: true,
  allowClose: false,
  steps: [
    {
      element: "#card-vehicle-in",
      popover: {
        title: "Vehicle In",
        description:
          "Diri nimo makita kung pila ka sakyanan ang nisulod sa parkingan.",
        side: "bottom",
        align: "start",
      },
    },
    {
      element: "#card-vehicle-out",
      popover: {
        title: "Vehicle Out",
        description:
          "Diri nimo makita kung pila ka sakyanan ang nigawas sa parkingan.",
        side: "bottom",
        align: "start",
      },
    },
    {
      element: "#card-vehicle-currently-parked",
      popover: {
        title: "Vehicle Currently Parked",
        description:
          "diri nimo makita kung pila ka sakyanan ang naka parking sa parkingan.",
        side: "bottom",
        align: "start",
      },
    },
    {
      element: "#parking-slots",
      popover: {
        title: "Parking Area",
        description:
          "Diri nimo makita tanang parkinganan, diri sad nimo makita kung ang parkingan naa bay sakyanan or wala. ang color niini nga walay sakyanan kay green, ang color pud niini nga adonay sakyanan kay color red, kini siya maoy tima-ilhan nga pwedi ba kini parkingan or dili kay naay sakyanan nga nag parking, ug diri sad nimo makita ang oras nga naka parking ang sakyanan sa parkinganan.",
        side: "bottom",
        align: "start",
      },
    },
    {
      element: "#parking-lot-image",
      popover: {
        title: "Parking Area Map",
        description:
          "Kani nga mapa, maonay mo giya kanimo kung asa ka dapit mo agi padulong sa parkinganan",
        side: "bottom",
        align: "start",
      },
    },
    {
      element: "#piechart",
      popover: {
        title: "Parking Pie Chart",
        description:
          "Diri nimo makita kung pila ka sakyanan ning gawas ug ning sulod. ang blue nga color maoy ga tudlo kung pila ka sakyanan ang hing sulod, ug ang green nga color maoy ga tudlo kung pila ka sakyanan ang ning gawas.",
        side: "bottom",
        align: "start",
      },
    },
    {
      element: "#parking-logs",
      popover: {
        title: "Parking Logs",
        description:
          "diri nimo makita ang record sa sakyanan, kung unsa nga adlaw ug oras kini hing sulod ug hing gawas, ug diri sad nimo makita kung asa siya naka parking sa parkinganan.",
        side: "bottom",
        align: "start",
      },
    },
    {
      popover: {
        title:
          "Maayong Adlaw ug Daghang Salamat sa pag bisita sa Gaisano Capital Pagadian City",
        description: "Ang Diyos Maga-uban kanato kanunay!",
      },
    },
  ],
});
