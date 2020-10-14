$("#co_so_dao_tao" ).change(function() {
    axios.post(routeGetMaNganhNghe, {
      id:  $("#co_so_dao_tao").val(),
    }).then(function (response) {
      var htmldata = '<option value="" >Chọn</option>'
      response.data.forEach(element => {
        htmldata+=`<option value="${element.id}" >${element.ten_nganh_nghe}-${element.id}</option>`   
      });
      if ($("#co_so_dao_tao").val()=='') {
        $('#ma_nganh_nghe').attr('disabled',true)
      }else{
        $('#ma_nganh_nghe').attr('disabled',false)
      }
      
      $('#ma_nganh_nghe').html(htmldata);
    }).catch(function (error) {
      console.log(error);
    });
  });
  var arrcheck=[];
  function getdatacheck(id) {
    var datacheck ={'id':$(id).attr('name'),'value':$(id).val()}
    var check = 0;
    
    if(arrcheck.length==0) { 
      check=1
      arrcheck.push(datacheck)
    } else {
      for (let index = 0; index < arrcheck.length; index++) {     
        if(datacheck.id==arrcheck[index].id){
          check=1;
          arrcheck[index].value=datacheck.value;
          break;
        }          
      }
    }
  
    if(check==0){
      arrcheck.push(datacheck)
    }
  
    if(arrcheck.length==4){
      axios.post(routeCheck, {
        datacheck: arrcheck,
      }).then(function (response) {
        if(response.data.result == 1){
          swal("Dữ liệu đã tồn tại và được phê duyệt", {
            buttons: ["OK"],
          })
          removeselect()
        }else if(response.data.result != 2){
          swal("Dữ liệu đã tồn tại mời chuyển đến trang chỉnh sửa", {
            buttons: ["Hủy", true],
          }).then(thanhcong=>{
            if(thanhcong != null){
              window.location=response.data.result;
            }    
          })
          removeselect()
        }
      }).catch(function (error) {
        console.log(error);
      });
    }
  }
  
  function removeselect() {
    arrcheck=[]
    $("#co_so_dao_tao").select2().val('').trigger('change');
    $('#nam').val('')
    $('#dot').val('')
  }