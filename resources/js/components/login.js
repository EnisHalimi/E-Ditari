
if(window.location.href.indexOf("login") > -1) {
    const sign_in_btn = document.querySelector("#sign-in-btn");
    const sign_up_btn = document.querySelector("#sign-up-btn");
    const container = document.querySelector(".container");
    if(!localStorage.View)
    {
        localStorage.View = 1;
    }
    else
    {
        if(localStorage.View == 1)
        {
            container.classList.remove("sign-up-mode");
        }
        else
        {
            container.classList.add("sign-up-mode");
        }
    }


    sign_up_btn.addEventListener("click", () => {
      container.classList.add("sign-up-mode");
      localStorage.View = 2;
    });

    sign_in_btn.addEventListener("click", () => {
      container.classList.remove("sign-up-mode");
      localStorage.View = 1;
    });




}
