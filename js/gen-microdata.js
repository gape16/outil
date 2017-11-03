$(function() {

  String.prototype.capitalize = function() {
    var split = this.split('');
    upper = false;
    $(split).each(function(i) {
      if (upper == false) {
        split[i] = this.toUpperCase();
        upper = true;
      }
      if (this == ' ') {
        upper = false;
      }
    });
    var join = split.join('');
    return join;
  };
  Object.size = function(obj) {
    var size = 0;
    key;
    for (key in obj) {
      if (obj.hasOwnProperty(key))
        size++;
    }
    return size;
  };

  //function to populate the form selector based
  //on the forms that are available.

  $('form').each(function() {
    // console.log($(this).attr('id'));
    if ($(this).attr('id') != 'selector' && typeof $(this).attr('id') !== 'undefined') {
      var option = $(this).attr('id');
      console.log(option);
      friendlyOption = option.replace('_', " ");
      $('select#form-selector').append('<option value="' + option + '">' + friendlyOption.capitalize() + '</option>');
    };
  });
  $('option').each(function() {
    //console.log($(this).html());
    if (!$(this).html() || $(this).html() === "") {
      $(this).html($(this).val());
    }
  });
  var selected,
  old,
  days = [];

  //changes the displayed form based on the selection


  var $timeKeeper = $('#timeKeeper').html();
  var $timeKeeper2 = $('#timeKeeper2').html();

  $('.openDays').change(function() {
    var lej=$(this).attr('data-day');
    if ($(this).is(':checked')) {
      days = [];
      $(this).after($timeKeeper2);
      $(this).after($timeKeeper);
      
      $('.openDays', selected).each(function() {
        if ($(this).is(':checked')) {
          days.push($(this).data('day'));

        }
      });
     // console.log(days);
     $(this).siblings(".closeHours2").after("<button class='aprem'>Ajouter une plage horaire</button>");
     $("."+lej+" .openHours2").css('display','none');
     $("."+lej+" .closeHours2").css('display','none');
   } else {
    $('.openHours2, .closeHours2', $(this).parent()).remove();
    $(this).siblings(".aprem").remove();
    $('.openHours, .closeHours', $(this).parent()).remove();
    var p = $.inArray($(this).data('day'), days);
    days.splice(p, 1);
      //console.log(days);
    }
  });

  $(document).on('click', '.aprem', function(e){
    e.preventDefault()
    $(this).siblings(".openHours2").css('display', 'block');
    $(this).siblings(".closeHours2").css('display', 'block');
    $(this).remove();
  })

  $(document).on('change', '.openHours select, .closeHours select, .openHours2 select, .closeHours2 select, .openDays', function() {
    var hourObj = hourCheck(days, selected),
    prevDayHours;
    var hourObj2 = hourCheck2(days, selected),
    prevDayHours;
    var dayList = '';
    var dayList2 = '';
    var finall = '';
    var hourKeys = Object.keys(hourObj).map(function(key) {
      return {
        key : key,
        used : false
      };
    });
    
    var hourKeys2 = Object.keys(hourObj2).map(function(key) {
      return {
        key : key,
        used : false
      };
    });

    hourKeys.forEach(function(keyObj, i) {
      if (keyObj.used) {
        return;
      }
      var size = hourKeys.length;
      var currentTime = hourObj[keyObj.key];

      keyObj.used = true;
      dayList += keyObj.key;

      hourKeys.forEach(function(k) {
        if (k.used || k.key === keyObj.key) {
          return;
        }
        if (currentTime === hourObj[k.key]) {
          dayList += ', ' + k.key;
          k.used = true;
        }
      });

      dayList += ' ' + hourObj[keyObj.key];

      if (i < size - 1) {
        dayList += ' ';
      }
    });
    hourKeys2.forEach(function(keyObj, i) {
      if (keyObj.used) {
        return;
      }
      var size = hourKeys2.length;
      var currentTime = hourObj2[keyObj.key];

      keyObj.used = true;
      dayList2 += keyObj.key;

      hourKeys2.forEach(function(k) {
        if (k.used || k.key === keyObj.key) {
          return;
        }
        if (currentTime === hourObj2[k.key]) {
          dayList2 += ', ' + k.key;
          k.used = true;
        }
      });

      dayList2 += ' ' + hourObj2[keyObj.key];

      if (i < size - 1) {
        dayList2 += ' ';
      }
    });
    dayList = dayList.trim();
    dayList2 = dayList2.trim();
    
    if($('.'+days[0]+' button').length){
      finall = dayList;
    } else {
      finall = dayList + ' ' + dayList2;
    }
    console.log(finall);
    $('.openingHours', selected).val(finall);
    $('.url', selected).keyup();

  });


  function hourCheck(days, selected) {
    var hours = {},
    $days = $(days);
    $days.each(function() {
      var _this = this;
      var openTime,
      closedTime,
      time;
      $('.days', selected).each(function() {
        if ($(this).hasClass(_this)) {
          openTime = $('.openHours select', this).val();
          closedTime = $('.closeHours select', this).val();
          time = openTime + '-' + closedTime;
          hours[_this] = time;
        }
      });
    });
    return hours;
  }

  function hourCheck2(days, selected) {
    var hours2 = {},
    $days2 = $(days);
    $days2.each(function() {
      var _this = this;
      var openTime2,
      closedTime2,
      time2;
      $('.days', selected).each(function() {
        if ($(this).hasClass(_this)) {
          openTime2 = $('.openHours2 select', this).val();
          closedTime2 = $('.closeHours2 select', this).val();
          time2 = openTime2 + '-' + closedTime2;
          hours2[_this] = time2;
        }
      });
    });
    return hours2;
  }



  $(".geoLat").on('keyup', function() {
    $(".geoMidpointLat").val($(this).val());
  })
  
  $(".geoLong").on('keyup', function() {
    $(".geoMidpointLong").val($(this).val());
  })



  var sameAsField = $('#sameAsHidden').html(),
  sameAsUrls = [],
  sameAsCount = 0,
  sameAsString = "";

  
  $("#reset").click(function() {
    $("pre").html("");
    sameAsCount = 0;
    $('input,textarea,select', selected).each(function() {
      if ($(this).attr('type') != 'hidden') {
        $(this).val("");
      }
    });
    $('#formholder form:not(#selector)').each(function() {
      $(this).css('display', 'none');
    });
  });

  old = selected;
  selected = "#local_business";
    //if (old) {//closes the old form
      //$(old).slideToggle();
    //}
    //$(selected).slideToggle();
    $("pre").html("");
    // clears out the <pre> container for the next one
    //cycles through the elements of the form and
    //clears the value on change.
    $('input,textarea').each(function() {
      if ($(this).attr('type') != 'hidden') {
        $(this).val("");
      };
    });

    //this function clears the <pre> and all fields
    //instantiate the object
    var element = {},
    $input = $(selected + ' input,' + selected + ' textarea,' + selected + ' select'),
    $rating = $('.rating', selected),
    $reviews = $('.reviews', selected),
    $contact = $('.contactType', selected),
    $phone = $('.telephone', selected),
    $address = $('.address', selected),
    $city = $('.addressLocality', selected),
    $poBox = $('.po-box', selected),
    $offerDesc = $('.offerDesc', selected),
    $offerURL = $('.offerURL', selected),
    $offerPrice = $('.offerPrice', selected),
    $locationName = $('.location-name', selected),
    $locationURL = $('.location-url', selected);
    $geoLat = $('.geoLat', selected);
    $geoLong = $('.geoLong', selected);
    $geoMidpointLat = $('.geoMidpointLat', selected);
    $geoMidpointLong = $('.geoMidpointLong', selected);
    $geoRadiusdist = $('.geoRadiusdist', selected);

    // fire when a key is pressed in an input or textarea
    $(document).on('keyup', $input, function() {

      // this iterates through the whole form.  @TODO see if there's a better way
      element = {};
      // this is highly inefficient, but it keeps things in order
      $input.each(function(e) {
        //selects the data-path attr and splits it if necessary.
        //the first is checked to see if it's alreay the key
        //and the second is used as the inner array
        if ($(this).data('path')) {
          var path = $(this).data('path').split('.');

          currentData = element;

          for (var i = 0; i < path.length - 1; i++) {
            if (!currentData[path[i]]) {
              //if the first part of data-path doesn't exist then it becomes
              //the key for this array
              currentData[path[i]] = {};
            }
            currentData = currentData[path[i]];
          }

          //if it's empty, then it doesn't exist
          currentData[path[path.length - 1]] = null;
          if ($(this).val().length > 0) {
            if (path == 'sameAs') {
              currentData[path[path.length - 1]] = $(this).val().split(';;');
            } else if (path == '@type') {
              currentData[path[path.length - 1]] = $(this).val().split(' ').join('');
            } else {
              currentData[path[path.length - 1]] = $(this).val();
            }
          }
          if (currentData[path[path.length - 1]] === null) {
            //get rid of the data that doesn't exist
            delete currentData[path[path.length - 1]];
          }
          //clear the empty values
          if (!$rating.val() && !$reviews.val()) {
            delete element.aggregateRating;
          }

          if (!$contact.val() && !$phone.val()) {
            delete element.contactPoint;
          }


          if (!$address.val() && !$city.val() && !$poBox.val()) {
            delete element.address;
            if (!$locationName.val() && !$locationURL.val()) {
              delete element.location;
            }
          }

          if (!$offerDesc.val() && !$offerURL.val() && !$offerPrice.val()) {
            delete element.offers;
          }

          if ($geoLat.val() == "" || $geoLong.val()== "") {
            delete element.geo;
          }

          if (!$geoMidpointLat.val()  || !$geoMidpointLong.val() || !$geoRadiusdist.val()) {
            delete element.areaServed;
          }

          //prep it for output
          $(".json").val("<scri" + "pt type='application/ld+json'> \n" + JSON.stringify(element, null, 2) + "\n </scri" + "pt>");
        }
      });
    });
  });
