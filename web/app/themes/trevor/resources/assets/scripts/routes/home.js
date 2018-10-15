import TweenLite from 'gsap/TweenLite'
import ScrollMagic from 'scrollmagic/scrollmagic/uncompressed/ScrollMagic'
import ScrollToPlugin from 'gsap/ScrollToPlugin'

export default {
  init() {
    // JavaScript to be fired on the home page

    // init controller
    var controller = new ScrollMagic.Controller();

    var portraiture_y = $('#portfolio__portraiture').outerHeight()
    new ScrollMagic.Scene({
      triggerElement: '#portfolio__portraiture',
      duration: portraiture_y})
      .addTo(controller)
      .on("update", function (e) {
        // console.log(e.target.controller().info("scrollDirection"));
      })
      .on("enter leave", function (e) {
        $('#link-portrait').toggleClass('active')
        // console.log(e.type == "enter" ? "inside" : "outside");
      })
      .on("start end", function (e) {
        // console.log(e.type == "start" ? "top" : "bottom");
      })
      .on("progress", function (e) {
        $('#link-portrait .progress').css('width', (e.progress * 100).toFixed(2) + '%')
      });

    var editorial_y = $('#portfolio__editorial').outerHeight()
    new ScrollMagic.Scene({
      triggerElement: '#portfolio__editorial',
      duration: editorial_y})
      .addTo(controller)
      .on("update", function (e) {
        // console.log(e.target.controller().info("scrollDirection"));
      })
      .on("enter leave", function (e) {
        $('#link-editorial').toggleClass('active')
        // console.log(e.type == "enter" ? "inside" : "outside");
      })
      .on("start end", function (e) {
        // console.log(e.type == "start" ? "top" : "bottom");
      })
      .on("progress", function (e) {
        // console.log(e.progress.toFixed(3));
        $('#link-editorial .progress').css('width', (e.progress * 100).toFixed(2) + '%')
      });

    var contact_y = $('#contact').outerHeight()
    new ScrollMagic.Scene({
      triggerElement: '#contact',
      duration: contact_y})
      .addTo(controller)
      .on("update", function (e) {
        // console.log(e.target.controller().info("scrollDirection"));
      })
      .on("enter leave", function (e) {
        // console.log(e.type == "enter" ? "inside" : "outside");
        $('#link-contact').toggleClass('active')
      })
      .on("start end", function (e) {
        // console.log(e.type == "start" ? "top" : "bottom");
      })
      .on("progress", function (e) {
        console.log(e.progress.toFixed(3));
        $('#link-contact .progress').css('width', (e.progress * 100).toFixed(2) + '%')
      });

    // change behaviour of controller to animate scroll instead of jump
    controller.scrollTo(function (newpos) {
      TweenLite.to(window, 1, {scrollTo: {y: newpos}});
    });

    //  bind scroll to anchor links
    $(document).on("click", "a[id^='link']", function (e) {
      var id = $(this).attr("href");
      id = '#' + id.split('#')[1]
      if ($(id).length > 0) {
        e.preventDefault();

        // trigger scroll
        controller.scrollTo(id);

        // if supported by the browser we can even update the URL.
        if (window.history && window.history.pushState) {
          history.pushState("", document.title, id);
        }
      }
    });

  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
