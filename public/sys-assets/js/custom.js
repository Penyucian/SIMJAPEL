var isset = function (variable) {
  return (
    typeof variable !== "undefined" &&
    variable !== null &&
    variable !== "" &&
    variable !== "null"
  );
};

function gen_datatable(p_table) {
  var pageLength = "25";
  if (typeof p_table.pageLength != "undefined" && p_table.pageLength !== null) {
    pageLength = p_table.pageLength;
  }
  var dttable = $("#" + p_table.id)
    .DataTable({
      destroy: true,
      processing: true,
      serverSide: true,
      responsive: true,
      lengthChange: true,
      searching: true,
      ordering: true,
      autoWidth: false,
      scrollCollapse: true,
      pageLength: pageLength,
      lengthMenu: [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, "All"],
      ],
      order: [],
      ajax: {
        url: p_table.url,
        type: "POST",
        data: function (d) {
          d.dt = JSON.stringify(
            $("#" + p_table.id + "_filter").serializeJSON()
          );
        },
        complete: function (a) {
          var d = JSON.parse(a.responseText);
          // $("input[name=csrf_ugmfw_token]").val(d.csrf_value);
        },
        error: function () {
          $(".datatables-error").html("Data tidak ditemukan");
        },
      },
      stateSave: false,
      columns: p_table.column,
      language: {
        processing:
          '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>',
        lengthMenu: "Per halaman _MENU_",
        zeroRecords: "Data tidak ditemukan",
        info: "Menampilkan _START_ s.d _END_ dari total _TOTAL_",
        infoEmpty: "Menampilkan 0 s.d _END_ dari total _TOTAL_",
        infoFiltered: "(filter dari _MAX_ total data)",
        paginate: {
          first: "Pertama",
          last: "Terakhir",
          next: "&gt;",
          previous: "&lt;",
        },
      },
    })
    .on("processing.dt", function (e, settings, processing) {
      if (processing) {
        $("#" + p_table.id).addClass("form-loading");
      } else {
        $("#" + p_table.id).removeClass("form-loading");
      }
    });
  $("#" + p_table.id + "_wrapper .table-caption").text(p_table.caption);
  $("#" + p_table.id + "_wrapper .dataTables_filter input").attr(
    "placeholder",
    "Cari..."
  );

  $("#" + p_table.id).on("draw.dt", function () {
    $(".confirm-remove").click(function () {
      var self = $(this);
      bootbox
        .confirm({
          title: "Konfirmasi",
          message: "Yakin data akan dihapus ?",
          buttons: {
            confirm: {
              label: "Ya",
              className: "btn-danger",
            },
            cancel: {
              label: "Tidak",
              className: "btn-default",
            },
          },
          callback: function (result) {
            if (result) {
              self.unbind("click");
              var action = self.attr("action");
              $.ajax({
                method: "GET",
                url: action,
                dataType: "json",
              }).done(function (response) {
                if (response.status == true || response.status == "success") {
                  $.growl.notice({
                    message: response.msg,
                    size: "large",
                  });
                } else {
                  var msg =
                    "Mohon maaf terjadi kesalahan, kami akan muat ulang halaman.";
                  if (isset(response.msg)) {
                    msg = response.msg;
                  }
                  $.growl.error({
                    message: msg,
                    size: "large",
                  });
                }
                setTimeout(function () {
                  $("#" + p_table.id)
                    .DataTable()
                    .draw(false);
                  $(".modal").modal("toggle");
                }, 500);
              });
              return false;
            }
          },
          className: "bootbox-sm",
        })
        .find(".modal-footer .btn-danger")
        .attr("action", self.attr("action"));
      return false;
    });

    $(".confirm-proses").click(function () {
      var self = $(this);
      bootbox
        .confirm({
          title: "Konfirmasi",
          message: "Yakin data akan diproses ?",
          buttons: {
            confirm: {
              label: "Ya",
              className: "btn-danger",
            },
            cancel: {
              label: "Tidak",
              className: "btn-default",
            },
          },
          callback: function (result) {
            if (result) {
              self.unbind("click");
              var action = self.attr("action");
              $.ajax({
                method: "GET",
                url: action,
                dataType: "json",
              }).done(function (response) {
                if (response.status == true || response.status == "success") {
                  $.growl.notice({
                    message: response.msg,
                    size: "large",
                  });
                } else {
                  var msg =
                    "Mohon maaf terjadi kesalahan, kami akan muat ulang halaman.";
                  if (isset(response.msg)) {
                    msg = response.msg;
                  }
                  $.growl.error({
                    message: msg,
                    size: "large",
                  });
                }
                setTimeout(function () {
                  $("#" + p_table.id)
                    .DataTable()
                    .draw(false);
                  $(".modal").modal("toggle");
                }, 500);
              });
              return false;
            }
          },
          className: "bootbox-sm",
        })
        .find(".modal-footer .btn-danger")
        .attr("action", self.attr("action"));
      return false;
    });
  });
}

function rupiah(nilai) {
  var reverse = nilai.toString().split("").reverse().join("");
  ribuan = reverse.match(/\d{1,3}/g);
  ribuan = ribuan.join(".").split("").reverse().join("");
  return ribuan;
}

$("body").delegate("form[rel='ajax-datatable']", "submit", function (e) {
  if (this.beenSubmitted) {
    return false;
  } else {
    this.beenSubmitted = true;
  }
  var objForm = $(this);
  var classHref = $(this).attr("class");
  if (typeof classHref !== "undefined" && classHref !== null) {
    var patt_xhr = /\s*xhr\s+/i;
    var patt_dest = /\s*dest\_[a-z\-\_0-9]*\s*/i;
    var xhr = classHref.match(patt_xhr);
    var dest = classHref.match(patt_dest);
    if (xhr !== null && dest !== null) {
      xhr = $.trim(xhr);
      dest = $.trim(dest);
      dest = dest.replace("dest_", "");
      if ($.trim(dest) === "") {
        dest = "subcontent-element";
      }
      $(".busy-indicator").fadeIn();
      $.ajax({
        type: "POST",
        url: objForm.attr("action"),
        data: objForm.serializeAndEncode(),
        success: function (data) {
          $(".busy-indicator").fadeOut();
          if (isJsonString(data)) {
            var obj = JSON.parse(data);
            if (obj["is_modal"] === 1) {
              $(".modal").modal("hide");
              if (obj["status"] == "success") {
                $("#datatables").DataTable().draw(false);
                $.growl.notice({
                  message: obj["msg"],
                  size: "large",
                });
              } else if (obj["status"] === "danger") {
                $("#datatables").DataTable().draw(false);
                $.growl.error({
                  message: obj["msg"],
                  size: "large",
                });
              } else if (obj["status"] === "warning") {
                $("#datatables").DataTable().draw(false);
                $.growl.warning({
                  message: obj["msg"],
                  size: "large",
                });
              }
            } else {
              if (obj["status"] === "success") {
                $("#datatables").DataTable().draw(false);
                $.growl.notice({
                  message: obj["msg"],
                  size: "large",
                });
              } else if (obj["status"] == "error") {
                $.growl.error({ message: objmsg, size: "large" });
                $(j.dest).html(j.html);
                $("#csrf").attr("name", j.csrf_name);
                $("#csrf").val(j.csrf_value);
              } else if (obj["status"] === "danger") {
                $("#datatables").DataTable().draw(false);
                $.growl.error({
                  message: obj["msg"],
                  size: "large",
                });
              } else if (obj["status"] === "warning") {
                $("#datatables").DataTable().draw(false);
                $.growl.warning({
                  message: obj["msg"],
                  size: "large",
                });
              }
            }
          } else if ($.trim(data) !== "") {
            $("#" + dest).fadeOut(200, function () {
              $("#" + dest).html(data);
              $("#" + dest).fadeIn(200);
              $(".busy-indicator").hide();
            });
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          $.growl.error({
            message: "Error " + jqXHR.responseText,
            size: "large",
          });
          $(".busy-indicator").hide();
        },
      });
      return false;
    }
  }
});

(function ($) {
  var Defaults = $.fn.select2.amd.require("select2/defaults");
  $.extend(Defaults.defaults, {
    dropdownPosition: "auto",
  });
  var AttachBody = $.fn.select2.amd.require("select2/dropdown/attachBody");
  var _positionDropdown = AttachBody.prototype._positionDropdown;
  AttachBody.prototype._positionDropdown = function () {
    var $window = $(window);
    var isCurrentlyAbove = this.$dropdown.hasClass("select2-dropdown--above");
    var isCurrentlyBelow = this.$dropdown.hasClass("select2-dropdown--below");
    var newDirection = null;
    var offset = this.$container.offset();
    offset.bottom = offset.top + this.$container.outerHeight(false);
    var container = {
      height: this.$container.outerHeight(false),
    };

    container.top = offset.top;
    container.bottom = offset.top + container.height;
    var dropdown = {
      height: this.$dropdown.outerHeight(false),
    };

    var viewport = {
      top: $window.scrollTop(),
      bottom: $window.scrollTop() + $window.height(),
    };

    var enoughRoomAbove = viewport.top < offset.top - dropdown.height;
    var enoughRoomBelow = viewport.bottom > offset.bottom + dropdown.height;

    var css = {
      left: offset.left,
      top: container.bottom,
    };

    // Determine what the parent element is to use for calciulating the offset
    var $offsetParent = this.$dropdownParent;

    // For statically positoned elements, we need to get the element
    // that is determining the offset
    if ($offsetParent.css("position") === "static") {
      $offsetParent = $offsetParent.offsetParent();
    }

    var parentOffset = $offsetParent.offset();

    css.top -= parentOffset.top;
    css.left -= parentOffset.left;

    var dropdownPositionOption = this.options.get("dropdownPosition");

    if (
      dropdownPositionOption === "above" ||
      dropdownPositionOption === "below"
    ) {
      newDirection = dropdownPositionOption;
    } else {
      if (!isCurrentlyAbove && !isCurrentlyBelow) {
        newDirection = "below";
      }

      if (!enoughRoomBelow && enoughRoomAbove && !isCurrentlyAbove) {
        newDirection = "above";
      } else if (!enoughRoomAbove && enoughRoomBelow && isCurrentlyAbove) {
        newDirection = "below";
      }
    }

    if (
      newDirection == "above" ||
      (isCurrentlyAbove && newDirection !== "below")
    ) {
      css.top = container.top - parentOffset.top - dropdown.height;
    }

    if (newDirection != null) {
      this.$dropdown
        .removeClass("select2-dropdown--below select2-dropdown--above")
        .addClass("select2-dropdown--" + newDirection);
      this.$container
        .removeClass("select2-container--below select2-container--above")
        .addClass("select2-container--" + newDirection);
    }

    this.$dropdownContainer.css(css);
  };
})(window.jQuery);
