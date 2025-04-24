<?php

namespace App\Http\Controllers;

use App\Models\Landlord;
use App\Http\Requests\StoreLandlordRequest;
use App\Http\Requests\UpdateLandlordRequest;

class LandlordController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreLandlordRequest $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Landlord $landlord)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Landlord $landlord)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateLandlordRequest $request, Landlord $landlord)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Landlord $landlord)
  {
    //
  }
}
