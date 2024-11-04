// Imagem Loader
function loader() {
    document.querySelector('.loader-container').classList.add('fade-out');
  }

  function fadeOut() {
    setInterval(loader, 3000);
  }
  
  window.onload = fadeOut;

  let newsletter = document.querySelector(".carded");
  
  window.onscroll = () => {
    let sectionInfo = document.querySelector("#blog_newspaper");
    let top = window.scrollY; // 0
    let height = sectionInfo.offsetHeight; 
    let offset = sectionInfo.offsetTop - 150; // 0

    if(top => offset && top > offset + height) {
        setTimeout(function() {newsletter.style.display = "none";}, 25000);

        newsletter.style.position = "fixed";
        newsletter.style.bottom = "3%";
        newsletter.style.right = "2%";
        newsletter.style.transition = ".5s ease";
        newsletter.style.marginTop = "2rem";

        let newsletterInputValid = newsletter.querySelector(".carded input");

        newsletterInputValid.onclick = () => {
            newsletter.style.position = "fixed";
            newsletter.style.display = 'inline-flex';
        };
    };
}; 

let closeNewsletter = document.querySelector("#close_card_form");

closeNewsletter.onclick = () => {
    newsletter.style.display = 'none';
    newsletter.style.transition = ".5s ease";
};

// Envio do Formulário de Contato 

function sendEmail(e) {
  e.preventDefault()

  Email.send({
      SecureToken: "a0abe762-e3ac-4bb1-a0cf-dbc214abdeb5",
  // Host : "smtp.gmail.com",
  // Username : "username", //Personal Email
  // Password : "password", // Password's Personal Email 
  To : 'joaoparreiras2020@gmail.com',
  From : document.getElementsByClassName("email").value,
  Subject : "New Contact Form Enquiry" + " Subject: " + document.getElementsByClassName("subject").value,
  Body : "Full Name: " + document.getElementsByClassName("name").value 
          + "<br> Email: " + document.getElementsByClassName("email").value
          + "<br> Message: " + document.getElementsByClassName("msg").value
}).then(
message => alert('Message Sent Succefully!'),
alert("Mensagem enviada!")
);
};