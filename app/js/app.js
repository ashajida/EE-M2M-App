const DOM = (() => {
  let message_box = document.querySelector(".messagebox");
  return {
    message_box
  };
})();

const UI = (() => {
  return {};
})();

const app = ((DOMElement, UIcontroller) => {
  fetch("http://localhost/soap_app/app/index.php/messages")
    .then(response => {
      return response.json();
    })
    .then(data => {
      let res_data = data.forEach(data => {
        return data;
      });

      document.querySelector(".messagebox").innerHTML += `<p>${data}</p>`;
      console.log(data);
    });

  return {};
})(DOM, UI);
