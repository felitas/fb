function getMonthName(month){
      switch(month){
        case 0:
          month = 'Januari';
          break;
        case 1:
          month = 'Februari';
          break;
        case 2:
          month = 'Maret';
          break;
        case 3:
          month = 'April';
          break;
        case 4:
          month = 'Mei';
          break;
        case 5:
          month = 'Juni';
          break;
        case 6:
          month = 'Juli';
          break;
        case 7:
          month = 'Agustus';
          break;
        case 8:
          month = 'September';
          break;
        case 9:
          month = 'Oktober';
          break;
        case 10:
          month = 'November';
          break;
        case 11:
          month = 'Desember';
          break;
        default: break;

      }

      return month;
    }

    function getDayName(number){
      switch(number){
        case 0:
          number = 'Minggu';
          break;
        case 1:
          number = 'Senin';
          break;
        case 2:
          number = 'Selasa';
          break;
        case 3:
          number = 'Rabu';
          break;
        case 4:
          number = 'Kamis';
          break;
        case 5:
          number = 'Jumat';
          break;
        case 6:
          number = 'Sabtu';
          break;
        default: break;
      }
     return number;
  }