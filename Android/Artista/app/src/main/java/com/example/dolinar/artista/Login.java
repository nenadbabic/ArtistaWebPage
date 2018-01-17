package com.example.dolinar.artista;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class Login extends AppCompatActivity {
    SharedPreferences sharedpreferences;

    private ArrayList<JSONObject> sellers;
    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.login_activity);
        getSellers();
        sharedpreferences = getSharedPreferences("session", Context.MODE_PRIVATE);

        final TextView usernameView = (TextView) findViewById(R.id.username_input);
        final TextView passwordView = (TextView) findViewById(R.id.input_password);

        Button btnLogin = (Button) findViewById(R.id.btn_login);

        btnLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (usernameView.getText().toString().equals("") || passwordView.getText().toString().equals("")) {
                    Toast.makeText(getApplicationContext(), "Vnesite vsa polja!", Toast.LENGTH_LONG).show();
                } else {

                    boolean loginOk = false;

                    for (int i = 0; i < sellers.size(); i++) {
                        JSONObject j = sellers.get(i);
                        try {
                            if (j.getString("email").equals(usernameView.getText().toString()) && j.getString("pwdhash").equals(passwordView.getText().toString())) {
                                SharedPreferences.Editor editor = sharedpreferences.edit();
                                editor.putString("email", usernameView.getText().toString());
                                editor.putString("username", j.getString("name"));
                                editor.apply();
                                loginOk = true;
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                    if (loginOk) {


                        Intent i = new Intent(getApplicationContext(), FrontPage.class);
                        startActivity(i);
                        finish();
                    } else {
                        Toast.makeText(getApplicationContext(), "Napacno uporabnisko ime ali geslo!", Toast.LENGTH_LONG).show();
                    }
                }
            }
        });




        TextView tv = (TextView)findViewById(R.id.link_signup);
        tv.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i = new Intent(getApplicationContext(), Registration.class);
                startActivity(i);
                finish();
            }
        });
    }

    private void getSellers() {

        String URL_FEED = "http://10.10.10.12:3000/Users";
        JsonObjectRequest jsonReq = new JsonObjectRequest(Request.Method.GET,
                URL_FEED, null, new Response.Listener<JSONObject>() {

            @Override
            public void onResponse(JSONObject response) {
                if (response != null) {
                    parseJsonFeed(response);
                }
            }
        }, new Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {
            }
        });

        // Adding request to volley request queue
        AppController.getInstance().addToRequestQueue(jsonReq);
    }

    private void parseJsonFeed(JSONObject jsonObject) {
        JSONArray feedArray = null;
        sellers = new ArrayList<>();
        try {
            feedArray = jsonObject.getJSONArray("user");

            for (int i = 0; i < feedArray.length(); i++) {
                 sellers.add((JSONObject) feedArray.get(i));
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

}
