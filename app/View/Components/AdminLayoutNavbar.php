<?php

namespace App\View\Components;

use App\Models\Absensi;
use App\Models\Intern;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminLayoutNavbar extends Component
{
    public $unapprovedCount;

    public $terakhirAbsensi;

    public $countNullUnits;
    public $terakhirUnitNull;

    public $totalNotifications;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Menghitung jumlah absensi yang belum disetujui
        $this->unapprovedCount = Absensi::countUnapproved();
        $this->terakhirAbsensi = Absensi::getLastCreatedTime();

        // Menghitung jumlah intern dengan unit_id null dan waktu pembuatan terakhir
        $internData = Intern::getCountAndLastItemWithNullUnit();
        $this->countNullUnits = $internData['count'];
        $this->terakhirUnitNull = isset($internData['lastItem']) && isset($internData['lastItem']['created_at'])
            ? $internData['lastItem']['created_at']
            : null;

        // Validasi nilai untuk totalNotifications
        $this->unapprovedCount = is_numeric($this->unapprovedCount) ? $this->unapprovedCount : 0;


        $this->totalNotifications = ($this->countNullUnits >= 1  ? 1 : 0) + ($this->unapprovedCount >= 1 ? 1 : 0);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-layout-navbar');
    }
}
