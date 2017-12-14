
var aa = $("#now_province").remove('option');
for (var i = 0; i < province.length; i++) {
    aa.append("<option value='" + i + "'>" + list[i] + "</option>");
}
$(function () {
    // 当省份被选择时触发
    $('#now_province').change(function () {
        //省份更改后，城市，县城的情况都要被全部更新（先清除，再添加）
        $("#now_city").css('display', 'none');
        $("#now_city").children().remove();
        $("#now_area").css('display', 'none');
        $("#now_area").children().remove();
        //获取省份value
        var value = this.value;
        //获取省份名称
        var name = $(this).find("option:selected").text();

        $("#now_city").append("<option value=''>请选择所在城市</option>");
        // 判断是否是直辖市
        if (value == 1 || value == 2 || value == 9 || value == 22) {

            $("#now_city").append("<option value='" + value + "'>" + name + "</option>");
            $("#now_city").css('display', 'inline');
            return false;
        }
        for (i in city) {
            if (i == value) {

                var nowcity = city[i]
            }
        }

        for (i in nowcity) {
            $("#now_city").append("<option value='" + i + "'>" + nowcity[i] + "</option>");
            $("#now_city").css('display', 'inline');
        }

    });
});