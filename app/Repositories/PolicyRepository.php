<?php

namespace App\Repositories;
use Illuminate\Http\Request;

use App\Interfaces\PolicyInterface;
use App\Policy;

class PolicyRepository implements  PolicyInterface {

    public function create_policy($property_id, Request $request) {

        /** Is there a better way to do this ? */
        $requestData    =   [
            'property_id'   =>  $property_id,
        ];
        $requestData = array_merge($requestData, $request->all());

        return Policy::create($requestData);
    }

    public function update_policy($property_id, $policy_id, Request $request) {

        $policy = Policy::where("id", $policy_id)->where("property_id", $property_id)->firstOrFail();
        $policy->update($request->all());
        return $policy;
    }

    public function get_policy($property_id, $policy_id) {

        if(is_null($policy_id)) {
            $policies = Policy::where("property_id", $property_id)->get();
        } else {
            $policies = Policy::where("id", $policy_id)->where("property_id", $property_id)->get();
        }

        return $policies;
    }

    public function delete_policy($property_id, $policy_id) {

        $policy = Policy::where("id", $policy_id)->where("property_id", $property_id)->firstOrFail();
        return $policy->delete();

    }

}