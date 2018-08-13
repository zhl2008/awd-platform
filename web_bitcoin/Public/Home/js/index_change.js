var ChangeNum = {
    dom: "cumulative",
    clkCls: "number_box",
    clkUnitCls: "unit",
    clkTopCls: "top",
    clkBtmCls: "btm",
    fCls: "add_f",
    wCls: "add_w",
    change_c: '',
    old_quota: '',
    quota: '',
    ClkUnit: function (val, minVal, maxVal, oCls) {
        arguments[3] || (oCls = ""),
            this.update = function () {
                this.updateTxt(),
                this.val > this.maxVal && (this.setVal(this.minVal), this.period()),
                this.val < this.minVal && (this.setVal(this.maxVal), this.period())
            },
            this.incVal = function () {
                this.val++,
                    this.update()
            },
            this.decVal = function () {
                this.val--,
                    this.update()
            },
            this.updateTxt = function () {
                this.val > 9 ? this.text = this.val : this.text = this.val
            },
            this.setVal = function (v) {
                this.val = v,
                    this.updateTxt()
            },
            this.pane = document.createElement("div"),
            this.pane.className = ChangeNum.clkUnitCls + " " + oCls,
            this.setVal(val),
            this.minVal = minVal,
            this.maxVal = maxVal,
            this.topbak = document.createElement("div"),
            this.topbak.txt = document.createElement("span"),
            this.topbak.className = ChangeNum.clkTopCls,
            this.topfnt = document.createElement("div"),
            this.topfnt.txt = document.createElement("span"),
            this.topfnt.className = ChangeNum.clkTopCls,
            this.btmbak = document.createElement("div"),
            this.btmbak.txt = document.createElement("span"),
            this.btmbak.className = ChangeNum.clkBtmCls,
            this.btmfnt = document.createElement("div"),
            this.btmfnt.txt = document.createElement("span"),
            this.btmfnt.className = ChangeNum.clkBtmCls,
            this.pane.appendChild(this.topbak),
            this.topbak.appendChild(this.topbak.txt),
            this.pane.appendChild(this.topfnt),
            this.topfnt.appendChild(this.topfnt.txt),
            this.pane.appendChild(this.btmbak),
            this.btmbak.appendChild(this.btmbak.txt),
            this.pane.appendChild(this.btmfnt),
            this.btmfnt.appendChild(this.btmfnt.txt),
            this.mtx = !1,
            this.animateReset = function () {
                ChangeNum.transform(this.btmfnt, ""),
                    ChangeNum.transform(this.btmbak, ""),
                    this.btmfnt.txt.innerHTML = this.text,
                    this.topbak.txt.innerHTML = this.text,
                    this.topfnt.txt.innerHTML = this.text,
                    this.btmbak.txt.innerHTML = this.text,
                    ChangeNum.transform(this.topfnt, ""),
                    ChangeNum.transform(this.topbak, "")
            },
            this.period = null,
            this.turnDown = function (v) {
                var u = this;
                if (!this.mtx) {
                    this.setVal(v);
                    var topDeg = 0,
                        btmDeg = 90;
                    this.topbak.txt.innerHTML = this.text,
                        ChangeNum.transform(u.topfnt, "rotateX(0deg)");
                    var timer1 = setInterval(function () {
                            if (ChangeNum.transform(u.topfnt, "rotateX(" + topDeg + "deg)"), topDeg -= 10, -90 >= topDeg) {
                                ChangeNum.transform(u.topfnt, "rotateX(0deg)"),
                                    u.topfnt.txt.innerHTML = u.text,
                                    ChangeNum.transform(u.btmfnt, "rotateX(90deg)"),
                                    u.btmfnt.txt.innerHTML = u.text;
                                var timer2 = setInterval(function () {
                                        0 >= btmDeg && (clearInterval(timer2), u.animateReset(), u.mtx = !1),
                                            ChangeNum.transform(u.btmfnt, "rotateX(" + btmDeg + "deg)"),
                                            btmDeg -= 10
                                    },
                                    30);
                                clearInterval(timer1)
                            }
                        },
                        30)
                }
            },
            this.animateReset()
    },
    Clock: function (prt, quota) {
        $("#" + ChangeNum.dom).html("");
        this.pane = document.createElement("div"),
            this.pane.className = ChangeNum.clkCls;
        var arr = new Array,
            str_arr = ChangeNum.quota.toString().split(""),
            bit = str_arr.length,
            mod = bit % 3,
            w = 60 * bit + 20 * parseInt(bit / 3) + 8 * (bit - parseInt(bit / 3));
        0 == mod && (w -= 20);
            prt.style.width = w + "px";
        for (var i = 0; bit > i; i++) {
            var cls = "";
            0 == i ? cls = ChangeNum.fCls : (i - mod) % 3 == 0 && (cls = ChangeNum.wCls),
                this.ng = new ChangeNum.ClkUnit(str_arr[i], 0, 9, cls),
                arr.push(this.ng),
                this.pane.appendChild(this.ng.pane)
        }
        prt.appendChild(this.pane);
        this.timer = null,
            this.make = function () {
                ChangeNum.quota.length != $("input[name='amount']").val().length && ($("input[name='amount']").val(ChangeNum.quota), $("#" + ChangeNum.dom).html(""), ChangeNum.change_c = new ChangeNum.Clock(document.getElementById("cumulative"), ChangeNum.quota));
                var yi = parseInt((ChangeNum.quota / 1e8).toFixed(4)),
                    wan = parseInt((ChangeNum.quota - 1e8 * yi) / 1e4),
                    bi = parseInt(ChangeNum.quota / 1e9),
                    mi = parseInt((ChangeNum.quota - 1e9 * bi) / 1e6);
                if (yi > 0) {
                    $(".yiyi1").show();
                    $(".yiyi2").show();
                }


                $("#yi").html(yi),


                    $("#wan").html(wan),
                    $("#bi").html(bi),
                    $("#mi").html(mi);
                var old_str_arr = ChangeNum.old_quota.toString().split("");
                var str_arr = ChangeNum.quota.toString().split("");
                for (var i = str_arr.length - 1; i >= 0; i--) {
                    if (old_str_arr[i] != str_arr[i]) {
                        arr[i].turnDown(str_arr[i])
                    }
                }
                ChangeNum.old_quota = ChangeNum.quota;

            },
            this.start = function () {
                this.make();
                var _this = this;
                this.timer = setInterval(function () {
                        _this.make()
                    },
                    5e3)
            },
            this.pause = function () {
                clearInterval(this.timer)
            },
            this.start()
    },
    transform: function (obj, tran) {
        try {
            obj.style.WebkitTransform = tran,
                obj.style.MozTransform = tran,
                obj.style.msTransform = tran,
                obj.style.OTransform = tran,
                obj.style.transform = tran
        } catch (e) {
        }
    },
}
window.setInterval(function () {
    $.get('/Ajax/allsum?t=' + Math.random(), function (t) {
        ChangeNum.quota = t;
        ChangeNum.change_c = new ChangeNum.Clock(document.getElementById(ChangeNum.dom), t);
    }, 'json');
}, 3000);




