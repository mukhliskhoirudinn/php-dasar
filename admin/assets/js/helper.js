// helper untuk mengubah text menjadi slug
$(document).ready(function () {
   $("#title").on("input", function () {
      $("#slug").val(slugify($(this).val()));
   });
});

const slugify = (text) => {
   return text
      .trim()
      .toLowerCase()
      .replace(/\s+/g, "-") //ganti spasi dengan -
      .replace(/[^\w\-]+/g, "") //hapus karakter non-alphanumeric
      .replace(/-+/g, "-"); //ganti beberapa - dengan satu
};
