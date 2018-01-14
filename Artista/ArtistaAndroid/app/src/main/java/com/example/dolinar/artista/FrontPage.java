package com.example.dolinar.artista;
import android.annotation.SuppressLint;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.support.annotation.NonNull;
import android.support.design.widget.NavigationView;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Cache;
import com.android.volley.Cache.Entry;
import com.android.volley.Request.Method;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.VolleyLog;
import com.android.volley.toolbox.JsonObjectRequest;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import java.util.List;

public class FrontPage extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener {
    private static final String TAG = FrontPage.class.getSimpleName();
    private ListView listView;
    private FeedListAdapter listAdapter;
    private List<FeedItem> feedItems;
    private String URL_FEED = "http://10.10.10.12:3000/Feed";

    String username;
    String email;

    @SuppressLint("NewApi")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_front_page);
        setNavigationViewListener();
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        // set navigation header
        SharedPreferences prefs = this.getSharedPreferences("session", Context.MODE_PRIVATE);
        username = prefs.getString("username", "temp");
        email = prefs.getString("email", "temp");
        NavigationView navigationView = (NavigationView) findViewById(R.id.navigation);
        View header = navigationView.getHeaderView(0);

        TextView nameTv = (TextView) header.findViewById(R.id.navigation_header_name);
        TextView emailTv = (TextView) header.findViewById(R.id.navigation_header_email);
        nameTv.setText(username);
        emailTv.setText(email);


        listView = (ListView) findViewById(R.id.list);

        feedItems = new ArrayList<FeedItem>();

        listAdapter = new FeedListAdapter(this, feedItems);
        listView.setAdapter(listAdapter);

        handleFeedRequest();

    }

    /**
     * Parsing json reponse and passing the data to feed view list adapter
     * */
    private void parseJsonFeed(JSONObject response) {
        try {
            JSONArray feedArray = response.getJSONArray("feed");

            for (int i = 0; i < feedArray.length(); i++) {

                JSONObject feedObj = (JSONObject) feedArray.get(i);


                FeedItem item = new FeedItem();
                item.setId(feedObj.getInt("seller"));
                item.setName(feedObj.getString("userName") + " - " + feedObj.getString("email"));

                // Image might be null sometimes
                String image = feedObj.isNull("path") ? null : "http://10.10.10.12:3000/" + feedObj
                        .getString("path");
                item.setImge(image);
                item.setStatus(feedObj.getString("name") + ": " + feedObj.getString("description"));
                item.setProfilePic("https://cdn.pixabay.com/photo/2017/10/18/10/15/stick-man-2863519_960_720.png");
                item.setTimeStamp(feedObj.getString("timestamp"));

                // url might be null sometimes
                String feedUrl = feedObj.isNull("price") ? null : feedObj
                        .getString("price") + " $";
                item.setUrl(feedUrl);

                feedItems.add(item);
            }

            // notify data changes to list adapater
            listAdapter.notifyDataSetChanged();
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }


    private void handleFeedRequest() {
        Cache cache = AppController.getInstance().getRequestQueue().getCache();
        Entry entry = cache.get(URL_FEED);
        if (entry != null) {
            // fetch the data from cache
            try {
                String data = new String(entry.data, "UTF-8");
                try {
                    parseJsonFeed(new JSONObject(data));
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            } catch (UnsupportedEncodingException e) {
                e.printStackTrace();
            }

        } else {
            // making fresh volley request and getting json
            JsonObjectRequest jsonReq = new JsonObjectRequest(Method.GET,
                    URL_FEED, null, new Response.Listener<JSONObject>() {

                @Override
                public void onResponse(JSONObject response) {
                    VolleyLog.d(TAG, "Response: " + response.toString());
                    if (response != null) {
                        parseJsonFeed(response);
                    }
                }
            }, new Response.ErrorListener() {

                @Override
                public void onErrorResponse(VolleyError error) {
                    VolleyLog.d(TAG, "Error: " + error.getMessage());
                }
            });

            // Adding request to volley request queue
            AppController.getInstance().addToRequestQueue(jsonReq);
        }
    }




    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.login:
                if (!username.equals("temp")) {
                    Toast.makeText(this, "V sistem ste ze prijavljeni!", Toast.LENGTH_LONG).show();
                } else {
                    Intent intentLogin = new Intent(this, Login.class);
                    this.startActivity(intentLogin);
                    finish();
                }

                return true;
            case R.id.registration:
                Intent intentRegistration = new Intent(this, Registration.class);
                this.startActivity(intentRegistration);
                return true;

            case R.id.logout:
                this.getSharedPreferences("session", Context.MODE_PRIVATE).edit().clear().apply();
                Toast.makeText(this, "Uspesno ste bili odjavljeni!", Toast.LENGTH_LONG).show();
                username = "temp";
                return true;
            default:
                return super.onOptionsItemSelected(item);
        }
    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        super.onCreateOptionsMenu(menu);
        menu.clear();
        getMenuInflater().inflate(R.menu.activity_front_page_drawer, menu);
        return true;
    }

    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        switch (item.getItemId()) {

            case R.id.overview: {
                Toast.makeText(this, "ok", Toast.LENGTH_LONG).show();
                break;
            }
            case R.id.addNew: {
                Intent intentAddNew = new Intent(this, AddNew.class);
                this.startActivity(intentAddNew);
                break;
            }
        }
        //close navigation drawer
        return true;
    }
    private void setNavigationViewListener() {
        NavigationView navigationView = (NavigationView) findViewById(R.id.navigation);
        navigationView.setNavigationItemSelectedListener(this);
    }


}