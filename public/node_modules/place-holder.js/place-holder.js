function isText(type) {
  if (type === "text") {
    return true;
  }
  return false;
}

function isEmail(type) {
  if (type === "email") {
    return true;
  }
  return false;

}

function isNumber(type) {
  if (type === "number") {
    return true;
  }
  return false;

}

function isPassword(type) {
  if (type === "password") {
    return true;
  }
  return false;

}

function isTel(type) {
  if (type === "tel") {
    return true;
  }
  return false;

}

function isURL(type) {
  if (type === "url") {
    return true;
  }
  return false;

}

var ele = $(":input");
var len = ele.length;
var i = 0;
var type = "";
for (i = 0; i < len; i++) {
  type = ele[i].type;
  if (!ele[i].placeholder) {
    if (isText(type)) {
      ele[i].placeholder = "Enter the Text";
    } else if (isEmail(type)) {
      ele[i].placeholder = "Enter the Email Address";
    } else if (isNumber(type)) {
      ele[i].placeholder = "Enter the Number";
    } else if (isPassword(type)) {
      ele[i].placeholder = "Enter the Password";
    } else if (isTel(type)) {
      ele[i].placeholder = "Enter the Mobile No.";
    } else if (isURL(type)) {
      ele[i].placeholder = "Enter the URL";
    }
  }
}

$("textarea").attr("placeholder", "Enter the message");